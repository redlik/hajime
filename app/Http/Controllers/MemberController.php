<?php

namespace App\Http\Controllers;

use App\Models\Gender;
use App\Models\Member;
use App\Models\Grade;
use App\Models\Membernote;
use App\Models\Membership;
use Auth;
use Illuminate\Http\Request;
use App\Models\Club;
use App\Models\MemberDocument;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('member.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $clubs = Club::orderBy('name')->get();
        $selectedClub = $request->query('club');
        $genders = Gender::all();


        return view('member.create', compact('clubs', 'selectedClub', 'genders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $club = Club::find($request->input('club_id'));
        $member = Member::create($request->all());

        activity()
            ->performedOn($member)
            ->causedBy(Auth::id())
            ->withProperty('name', $member->first_name . ' ' . $member->last_name )
            ->log('New member created');

        return redirect()->route('member.show', $member);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        $grades = Grade::where('member_id', $member->id)->orderBy('grade_date', 'desc')->get();
        $memberships = Membership::where('member_id', $member->id)->orderBy('expiry_date', 'desc')->get();
        $notes = Membernote::where('member_id', $member->id)->orderBy('created_at', 'desc')->get();
        $forms = MemberDocument::form($member->id)->get();
        $documents = MemberDocument::document($member->id)->get();
        return view('member.show-tabs', compact('member', 'grades', 'memberships', 'notes', 'forms', 'documents'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        $member = DB::table('members')->find($member->id);
        $clubs = Club::orderBy('name')->get();
        $genders = Gender::all();



        return view('member.edit', compact('member', 'clubs', 'genders'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
        $input = $request->all();
        $member->fill($input)->save();

        activity()
            ->performedOn($member)
            ->causedBy(Auth::id())
            ->withProperty('name', $member->first_name . ' ' . $member->last_name )
            ->log('Member details updated');


        return back()->with('message', 'Record Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        //
    }

    public function duplicate(Request $request)
    {
        $member = Member::create($request->all());
        $clubs = Club::orderBy('name')->get();
        $genders = Gender::all();

        return view('member.duplicate', compact('member', 'clubs', 'genders'));
    }

    public function duplicateExisting($id) {
        $existing = Member::find($id);
        $member = $existing->replicate();
        $genders = Gender::all();

        $clubs = Club::orderBy('name')->get();

        return view('member.duplicate', compact('member', 'clubs', 'genders'));

    }
}
