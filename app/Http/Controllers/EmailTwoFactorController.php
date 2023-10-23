<?php

namespace App\Http\Controllers;

use App\Models\UserCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EmailTwoFactorController extends Controller
{
    public function index()
    {
        return view('auth.2fa');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code'=>'required',
        ]);

        $find = UserCode::where('user_id', auth()->user()->id)
            ->where('code', $request->code)
            ->where('updated_at', '>=', now()->subMinutes(2))
            ->first();

        ray($find);

        if (!is_null($find)) {
            Session::put('user_2fa', auth()->user()->id);
            return redirect()->route('club.access.club');
        }

        return back()->withErrors(['code' =>'You entered wrong code.']);
    }

    public function resend()
    {
        auth()->user()->generateCode();

        return back()->with('resend', 'We sent a new code to your email.');
    }
}
