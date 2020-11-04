<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Grade;
use App\Models\Membership;
use Illuminate\Http\Request;
use App\Models\Club;

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
        $clubs = Club::get();
        $selectedClub = $request->query('club');


        return view('member.create', compact('clubs', 'selectedClub'));
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

        return redirect()->action('App\Http\Controllers\ClubController@show', ['club' => $club->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        $grades = Grade::where('member_id', $member->id)->orderby('grade_date', 'desc')->get();
        $memberships = Membership::where('member_id', $member->id)->get();
        return view('member.show', compact('member', 'grades', 'memberships'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        //
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
        //
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
}