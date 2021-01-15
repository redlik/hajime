<?php

namespace App\Http\Controllers;

use App\Events\NewMembershipEvent;
use App\Models\Membership;
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $membership = Membership::create($request->all());
        $member = Member::find($request->input('member_id'));
        if (\Carbon\Carbon::now()->lessThan($membership->expiry_date)) {
            $member->active = 1;
            $member->save();
        }
        // Fire new event when new membership is created
//        event(new NewMembershipEvent($membership));

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
        $member = member::find($request->input('member_id'));
        $membership = Membership::where('id', $membership->id)->delete();
        $memberships = Membership::where('member_id', $request->input('member_id'))->get();
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

        return redirect()->action('App\Http\Controllers\MemberController@show', ['member' => $member]);
    }
}
