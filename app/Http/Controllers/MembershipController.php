<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use Auth;
use Illuminate\Http\Request;
use App\Models\Member;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $membership = Membership::create($request->all());
        $member = Member::find($request->input('member_id'));
        if (\Carbon\Carbon::now()->lessThan($membership->expiry_date)) {
            $member->active = 1;
            $member->save();
        }

        activity()
            ->performedOn($member)
            ->causedBy(Auth::id())
            ->withProperty('name', $member->first_name . ' ' . $member->last_name )
            ->log('New membership added');

        return Redirect::to(URL::previous() . "#membership");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function show(Membership $membership)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function edit(Membership $membership)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Membership $membership)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Membership $membership)
    {
        $membership = Membership::find($membership->id);
        $member = member::find($membership->member_id);
        $membership->delete();
        $memberships = Membership::where('member_id', $member->id)->get();
        if ($memberships->isEmpty()) {
            $member->active = 0;
            $member->save();
        }
        foreach ($memberships as $existing_membership) {
            if (\Carbon\Carbon::now()->greaterThan($existing_membership->expiry_date)) {
                $member->active = 0;
                $member->save();
            }
        }

        activity()
            ->performedOn($member)
            ->causedBy(Auth::id())
            ->withProperty('name', $member->first_name . ' ' . $member->last_name )
            ->log('Membership removed');

        return Redirect::to(URL::previous() . "#membership");
    }
}
