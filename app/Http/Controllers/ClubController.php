<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\ClubDocument;
use App\Models\GradForm;
use App\Models\Personnel;
use App\Models\Coach;
use App\Models\Clubnote;
use App\Models\User;
use App\Models\Venue;
use App\Models\Volunteer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Membership;
use DB;

class ClubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clubs = Club::paginate(25);
        return view('clubs.index', compact('clubs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clubs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:clubs']);
        if($request->input('ethics_assessment') == 0) {
            $request->merge([
                'ethics_assessment_date' => '',
            ]);
        }
        $club = Club::create($request->all());
//        $personnel = self::personnel($club);
        $personnel = $this->personnel($club);

        return redirect()->action('App\Http\Controllers\ClubController@show', ['club' => $club]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Club  $club
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Club $club)
    {
        $access = false;
        $email = '';

        if ($user = User::where('club_id', $club->id)->first() ) {
            $access = true;
            $email = $user->email;
        }

        $headCoach = Personnel::headcoach()->where('club_id', $club->id)->first();
        $secretary = Personnel::secretary()->where('club_id', $club->id)->first();
        $designated = Personnel::designatedofficer()->where('club_id', $club->id)->first();
        $childrens = Personnel::childrenofficer()->where('club_id', $club->id)->first();
        $members = Member::where('club_id', $club->id)->get();
        $coaches = Coach::where('club_id', $club->id)->get();
        $volunteers = Volunteer::where('club_id', $club->id)->get();
        $venues = Venue::where('club_id', $club->id)->get();
        $notes = Clubnote::where('club_id', $club->id)->orderBy('created_at', 'desc')->get();
        $forms = ClubDocument::form($club->id)->get();
        $grads = GradForm::where('club_id', $club->id)->orderBy('title', 'desc')->get();
        $documents = ClubDocument::document($club->id)->get();

        return view('clubs.show', compact('club', 'venues', 'volunteers', 'members', 'notes', 'headCoach', 'secretary',
        'designated', 'childrens', 'forms', 'documents', 'coaches', 'grads', 'access', 'user' ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function edit(Club $club)
    {
        $club = DB::table('clubs')->find($club->id);

        return view('clubs.edit', compact('club'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Club $club)
    {
        if($request->input('ethics_assessment') == 0) {
            $request->merge([
                'ethics_assessment_date' => NULL,
            ]);
        }
        $input = $request->all();
        $club->fill($input)->save();
        return back()->with('message', 'Record Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function destroy(Club $club)
    {
        //
    }

    public function personnel(Club $club) {
        $personnel = array(
            'Head Coach'=>Personnel::headcoach()->where('club_id', $club->id)->first(),
            'Secretary' => Personnel::secretary()->where('club_id', $club->id)->first(),
            'Designated Officer' => Personnel::designatedofficer()->where('club_id', $club->id)->first(),
            'Childrens Officer' => Personnel::childrenofficer()->where('club_id', $club->id)->first(),
            'Coach' => Personnel::coach()->where('club_id', $club->id)->first(),
            'Volunteer' => Personnel::volunteer()->where('club_id', $club->id)->first(),
            );
        return $personnel;
    }

    public function checkMemberships($club) {
        $members = Member::where('club_id', $club)->where('active', 1)->with('membership')->get();
        $changed = 0;
        foreach ($members as $member) {
            $membership = Membership::where('member_id', $member->id)->orderBy('expiry_date', 'desc')->first();
            if (Carbon::now()->greaterThan($membership->expiry_date))
            {
                    $member->active = 0;
                    $member->save();
                    $changed += 1;
                }
        }
        $message = 'Memberships updated successfully. Changed records: '.$changed;
        return redirect()->to(url()->previous() . '#members')->with('message', $message);
    }
}
