<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Membership;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ActiveMemberController extends Controller
{
    public function showView()
    {
        return view('member.checkMembership');
    }

    public function checkMembershipsGlobally()
    {
        $members = Member::where('active', 1)->with('membership')->get();
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

        return redirect()->to(url()->previous())->with('message', $message);
    }
}
