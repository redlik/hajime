<?php

namespace App\Http\Controllers;

use App\Mail\AccountActivated;
use App\Mail\EmailVerificationRequest;
use App\Mail\SendMobileActivationCode;
use App\Mail\UserInvitation;
use App\Models\Club;
use App\Models\Grade;
use App\Models\Member;
use App\Models\Membership;
use App\Models\MobileToken;
use App\Models\User;
use Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Log;

class UserController extends Controller
{
    public function redirects()
    {
        if (Auth::user()->hasRole('admin')) {
            return redirect()->route('clubs.index');
        }
        elseif  (Auth::user()->hasRole('manager')){
            return redirect()->route('club.access.club');
        }
        else {
            return route('home');
        }
    }

    public function activateAccount(Request $request)
    {
        $user = User::find($request->input('user'));

        $user->update([
            'status' => 'active'
        ]);

        Mail::to($user)->send(new AccountActivated($user));

        \Session::flash('message', 'User account activated');

        return redirect()->back();
    }

    public function userActivationLink($user_id)
    {
        $user = User::find($user_id);
        if ($user->status == 'active') {
            abort(403, 'Account is already activated');
        }

        return view('club-access.registration', compact('user'));
    }

    public function userActivatedAccount(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

        $user = User::find($request->input('id'));

        $user->update([
           'name' => $request->input('name'),
           'password' => Hash::make($request->input('password')),
            'status' => 'active',
        ]);

        \Session::flash('activated', 'Congratulations, your account has been activated.');

        return view('home-new');
    }

    public function deactivateUser(Request $request)
    {
        $user = User::find($request->input('user'));

        $user->update([
            'status' => 'deactivated'
        ]);

        \Session::flash('message', 'User account deactivated');

        return redirect()->back();
    }

    public function inviteUser(Request $request)
    {
        if (User::whereEmail($request->input('email'))->first()) {
            abort(403, "User with this email already exists");
        }
        $user = User::create(
            [
                'name' => 'Invite Pending',
                'email' => $request->input('email'),
                'club_id' => $request->input('club'),
                'password' => Hash::make(Str::uuid()->toString()),
            ]
        );

        $user->assignRole('manager');

        $club = Club::find($request->input('club'));

        activity()
            ->performedOn($user)
            ->causedBy(Auth::id())
            ->withProperty('name', $user->email )
            ->log('New invitation to manage '. Str::limit($club->name, 25 , '(...)'));

        Mail::to($user)->send(new UserInvitation($user));

        return redirect()->back()->with('invited', "Account invitation has been sent");
    }

    public function deleteUser(User $user)
    {
        $user->delete();

        \Session::flash('message', 'User account deleted');

        return redirect()->back();
    }

    public function settings()
    {
        return view('club-access.settings');
    }

    public function requestEmailVerification(User $user)
    {
        $user->update([
            'email_request_status' => 'requested',
        ]);

        Mail::to(config('mail.admin_email'))->send(new EmailVerificationRequest($user));

        return redirect()->back()->with('request-sent', 'Your request has been passed to Hajime admins');
    }

    public function assignRoles()
    {
        $users = User::all();
        foreach ($users as $user) {
            $user->assignRole('admin');
        }

        echo('Roles assigned');
    }

    public function softDeleteAdmin(User $admin)
    {
        $admin->delete();

        \Session::flash('message', 'User account deleted');

        return redirect()->back();
    }

    public function registerAPIuser(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|regex:/(.*)@cloudni\.co\.uk/i|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()]);
        } else {
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]);

            $token = $user->createToken('api_token');

            return response()->json(['api_token' => $token->plainTextToken]);
        }
    }

    public function activateMobile(Request $request)
    {
        $activator = new ActivationCodesController();

        $validator = \Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()]);
        } else {
            $member = Member::where('email', $request->input('email'))->firstOrFail();
            $code = $activator->generateCode();

            $activator->saveCode($member->email);

            Mail::to($member->email)->send(new SendMobileActivationCode($code));

            return response()->json([
                'email' => $member->email,
                'message' =>"Activation code sent to the email",
            ]);
        }
    }

    public function activateMobileWithLicence(Request $request)
    {
        $activator = new ActivationCodesController();

        $validator = \Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|exists:members,email',
            'licence' => 'required|exists:members,number',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()]);
        } else {
            $member = $this->checkIfFieldsMatch($request);
            ray($member);

            $activator->resetLimit($request);

            $activator->checkDeviceLimit($member);

            $code = $activator->generateCode();

            $activator->saveCode($member);

            Mail::to($member->email)->send(new SendMobileActivationCode($code));

            Log::info("Mobile activation code sent to {$member->email}");

            return response()->json([
                'email' => $member->email,
                'message' =>"Activation code sent to the email",
            ]);
        }
    }

    public function checkIfFieldsMatch(Request $request)
    {
        try {
            $member = Member::where('email', $request->email)
                ->where('number', trim($request->licence))
                ->firstOrFail();
        }
        catch (ModelNotFoundException) {
            exit(json_encode(['error'=>'The email and licence number do not match']));
        }

        return $member;
    }
    public function refreshMobileApplication(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'token' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()]);
        } else {
            $token = MobileToken::where('token', $request->input('token'))->firstOrFail();
            $member = Member::where('id', $token->member_id)->first();

            $membership = Membership::where('member_id', $member->id)
                ->orderBy('expiry_date', 'desc')
                ->first();

            $grade = Grade::where('member_id', $member->id)
                ->orderBy('grade_date', 'desc')
                ->first();

            $tokens = MobileToken::where('member_id', $member->id)->count();

            $token->touch();

            return response()->json([
                'club' => $member->club->name,
                'membership_type' => $membership->membership_type ?? 'none',
                'membership_expiry' => $membership->expiry_date ?? 'none',
                'grade_level' => $grade->grade_level ?? 'none',
                'grade_points' => $grade->grade_points ?? 'none',
                'active_tokens' => $tokens,
                'updated_at' => Carbon::now()->toDateString(),
            ]);
        }
    }
}
