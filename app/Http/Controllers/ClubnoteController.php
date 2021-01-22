<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Clubnote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ClubnoteController extends Controller
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

    }

    public function createWithClub($club)
    {
        $club_id = $club;
        return view('clubnote.create', compact('club_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $note = new Clubnote();
        $slug = Str::slug($request->input('title'), '-');
        $note->slug = $slug;
        $note->title = $request->input('title');
        $note->body = $request->input('body');
        $note->club_id = $request->input('club_id');
        $note->author = $request->input('author');
        $note->save();

        $note->slug = $note->id."-".$note->slug;
        $note->save();

        return redirect()->action('App\Http\Controllers\ClubController@show', ['club' => $note->club_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clubnote  $clubnote
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $note = Clubnote::where('slug', $slug)->first();
        return view('clubnote.show', compact('note'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clubnote  $clubnote
     * @return \Illuminate\Http\Response
     */
    public function edit(Clubnote $clubnote)
    {
        $note = DB::table('clubnotes')->find($clubnote->id);
        return view('clubnote.edit', compact('note'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clubnote  $clubnote
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Clubnote $clubnote)
    {
        $input = $request->all();
        $clubnote->slug = Str::slug($clubnote->id."-".$request->input('title'), '-');
        if (!$clubnote->author) {
            $clubnote->author = Auth::user()->id;
        }
        $clubnote->fill($input)->save();
        return back()->with('message', 'Record Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clubnote  $clubnote
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Clubnote $clubnote)
    {
        $club = Club::where('id', $clubnote->club_id)->first();
        $clubnote = Clubnote::findOrFail($clubnote->id);

        $clubnote->delete();

        return Redirect::to(URL::previous() . "#notes");

    }
}
