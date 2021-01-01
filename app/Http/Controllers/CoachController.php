<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coach;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class CoachController extends Controller
{
    public function addCoach($club_id) {
        return view('coach.create', compact('club_id'));
    }

    public function store(Request $request)
    {
        $coach = Coach::create($request->all());
        $club = $request->input('club_id');

        return redirect()->route('clubs.show', $club);
    }

    public function edit($id)
    {
        $coach = Coach::find($id);

        return view('coach.edit', compact('coach'));
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
        return redirect()->back();
    }
}
