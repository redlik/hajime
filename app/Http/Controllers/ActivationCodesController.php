<?php

namespace App\Http\Controllers;

use App\Models\ActivationCodes;
use App\Models\Grade;
use App\Models\Member;
use App\Models\Membership;
use App\Models\MobileToken;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class ActivationCodesController extends Controller
{
    public $code;
    public function generateCode()
    {
        $this->code = rand(100000, 999999);
        return $this->code;
    }

    public function saveCode(Member $member): void
    {
        ActivationCodes::create([
            'code' => $this->code,
            'email' => $member->email,
            'licence' => $member->number,
            'expires_at' => now()->addMinutes(120),
        ]);
    }

    public function activateCode(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'code' => 'required|string|max:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()]);
        }

        try {
            $activation = ActivationCodes::query()->where('code', $request->code)->firstOrFail();
        } catch (ModelNotFoundException) {
            return response()->json(['error'=>'Activation code not found']);
        }

        $this->checkIfValid($activation);

//        $this->resetLimit($request);

        try {
            $member = Member::query()->where('number', $activation->licence)
                ->firstOrFail();
        } catch (ModelNotFoundException) {
            return response()->json(['error'=>'Licence number not found']);
        }

//        $this->checkDeviceLimit($member);

        $membership = Membership::where('member_id', $member->id)
            ->orderBy('expiry_date', 'desc')
            ->first();

        $grade = Grade::where('member_id', $member->id)
            ->orderBy('grade_date', 'desc')
            ->first();

        $mobileToken = new MobileTokenController();
        $token = MobileToken::create(
            [
                'token' => Str::random(128),
                'member_id' => $member->id,
                'status' => true,
                'expires_at' => now()->addDays(365),
            ]
        );;
        $activation->delete();

        $tokens = MobileToken::where('member_id', $member->id)->count();

        return response()->json([
            'first_name' => $member->first_name,
            'last_name' => $member->last_name,
            'licence_number' => $member->number,
            'club' => $member->club->name,
            'membership_type' => $membership->membership_type ?? 'none',
            'membership_expiry' => $membership->expiry_date ?? 'none',
            'grade_level' => $grade->grade_level ?? 'none',
            'grade_points' => $grade->grade_points ?? 'none',
            'token' => $token->token,
            'active_tokens' => $tokens,
            'updated_at' => Carbon::now()->toDateString(),
        ]);

    }

    public function checkIfValid($activation) {
        if ($activation->expires_at < now()) {
            $activation->delete();
            return response()->json('The activation code has expired');
        }
    }

    public function checkDeviceLimit($member)
    {
        $activations = MobileToken::query()->where('member_id', $member->id)->count();
        ray("Activations ".$activations);
        if($activations >= 2) {
            $reset_code = Str::random(6);
            Cache::add($reset_code, $member->id, Carbon::now()->addMinutes(30));
            exit(json_encode([
                'error' => "Device limit exceeded",
                'reset_code' => $reset_code]));
        }
    }

    public function resetLimit($request) {
        if($request->reset && Cache::has($request->reset)) {
            $oldest_token = MobileToken::where('member_id', Cache::get($request->reset))
                ->orderBy('updated_at', 'asc')
                ->first();
            ray($oldest_token);
            $oldest_token->delete();
        }
    }
}
