<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Models\Coach;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class CoachController extends Controller
{
    public function addCoach($club_id) {
        $members = Member::where('club_id', $club_id)->select('id', 'first_name', 'last_name')->orderBy('last_name')->get();
        return view('coach.create', compact('club_id', 'members'));
    }

    public function store(Request $request)
    {
        $coach = Coach::create($request->all());
        $club = $request->input('club_id');

        return redirect('/clubs/'.$club."#personnel");
    }

    public function edit($id)
    {
        $coach = Coach::find($id);
        $members = Member::where('club_id', $coach->club_id)->select('id', 'first_name', 'last_name')->orderBy('last_name')->get();

        return view('coach.edit', compact('coach', 'members'));
    }

    public function update(Request $request, Coach $coach)
    {
        $input = $request->all();
        $coach->fill($input)->save();

        return back()->with('message', 'Record Successfully Updated!');
    }

    public function destroy($coach)
    {
        Coach::destroy($coach);
        return Redirect::to(URL::previous() . "#personnel");
    }
}
