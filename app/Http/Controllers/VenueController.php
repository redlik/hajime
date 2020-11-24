<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\File;

class VenueController extends Controller
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
    public function createWithClub($club)
    {
        return view('venue.create', compact('club'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $venue = Venue::create($request->all());
        $club = $request->input('club_id');

        $fileName = time().'_'.$request->file('attachment')->getClientOriginalName();
        $filePath = $request->file('attachment')->storeAs('attachments', $fileName, 'public');

        $venue->attachment = $filePath;
        $venue->save();

        return redirect()->route('clubs.show', $club);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function show(Venue $venue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $venue = Venue::findOrFail($id);

        return view('venue.edit', compact('venue'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venue $venue)
    {
        $input = $request->all();
//        if ($request->file('attachment')) {
//            Storage::delete('attachments/'.$venue->attachment);
//        }
        if(File::exists(public_path('storage/attachments/'.$venue->attachment))){
            File::delete(public_path('storage/attachments/'.$venue->attachment));
        }else{
            dd('File does not exists.');
        }

        $venue->fill($input)->save();

        $fileName = time().'_'.$request->file('attachment')->getClientOriginalName();
        $filePath = $request->file('attachment')->storeAs('attachments', $fileName, 'public');

        $venue->attachment = $fileName;
        $venue->save();

        return back()->with('message', 'Record Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Venue::where('id', $id)->delete();

        return Redirect::to(URL::previous()."#venues");
    }
}
