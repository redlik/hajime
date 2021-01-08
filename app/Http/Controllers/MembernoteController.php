<?php

namespace App\Http\Controllers;

use App\Models\Membernote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class MembernoteController extends Controller
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

    public function createWithMember($member) {
        $member_id = $member;
        $url = url()->previous().'#notes';
        return view('membernote.create', compact('member_id', 'url'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $note = new Membernote();
        $slug = Str::slug($request->input('title'), '-');
        $note->slug = $slug;
        $note->title = $request->input('title');
        $note->body = $request->input('body');
        $note->member_id = $request->input('member_id');
        $note->save();

        $note->slug = $note->id."-".$note->slug;
        $note->save();

//        return redirect()->action('App\Http\Controllers\MemberController@show', ['member' => $note->member_id]);
        return redirect($request->input('url'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Membernote  $membernote
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $note = Membernote::where('slug', $slug)->first();
        return view('membernote.show', compact('note'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Membernote  $membernote
     * @return \Illuminate\Http\Response
     */
    public function edit(Membernote $membernote)
    {
        $note = DB::table('membernotes')->find($membernote->id);
        return view('membernote.edit', compact('note'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Membernote  $membernote
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Membernote $membernote)
    {
        $input = $request->all();
        $membernote->slug = Str::slug($membernote->id."-".$request->input('title'), '-');
        $membernote->fill($input)->save();
        return back()->with('message', 'Record Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Membernote  $membernote
     * @return \Illuminate\Http\Response
     */
    public function destroy(Membernote $membernote)
    {
        $membernote = Membernote::findOrFail($membernote->id);

        $membernote->delete();

        return Redirect::to(URL::previous() . "#notes");
    }
}
