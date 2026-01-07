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
        $changed = Member::deactivateExpiredMemberships();

        $message = 'Memberships updated successfully. Changed records: '.$changed;

        return redirect()->to(url()->previous())->with('message', $message);
    }
}
