<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Personnel;
use Illuminate\Http\Request;
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
        // dd($request);
        $club = Club::create($request->all());
        $personnel = Personnel::where('club_id', $club->id)->get();
        return redirect()->route('clubs.show', $club, $personnel);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function show(Club $club)
    {
        $personnel = self::personnel($club);

        return view('clubs.show', compact('club', 'personnel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function edit(Club $club)
    {
        //
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
        //
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
            'Children Officer' => Personnel::childrenofficer()->where('club_id', $club->id)->first(),
            'Coach' => Personnel::coach()->where('club_id', $club->id)->first(),
            'Volunteer' => Personnel::volunteer()->where('club_id', $club->id)->first(),
            );
        return $personnel;
    }
}
