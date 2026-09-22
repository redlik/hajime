<?php

namespace App\Http\Controllers;

use App\Models\Qualification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class QualificationController extends Controller
{
    /**
     * Maps a qualification `type` to the member-profile tab anchor it belongs to.
     */
    private const TYPE_ANCHORS = [
        'referee' => 'referee',
        'table_official' => 'tableofficial',
        'coach' => 'coach',
    ];

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created qualification record.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:referee,table_official,coach',
            'member_id' => 'required|exists:members,id',
            'level' => 'required|string',
        ]);

        Qualification::create($request->all());

        return Redirect::to(URL::previous() . '#' . self::TYPE_ANCHORS[$request->input('type')]);
    }

    public function show(Qualification $qualification)
    {
        //
    }

    public function edit(Qualification $qualification)
    {
        //
    }

    public function update(Request $request, Qualification $qualification)
    {
        //
    }

    /**
     * Remove the specified qualification record.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Qualification  $qualification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Qualification $qualification)
    {
        $anchor = self::TYPE_ANCHORS[$qualification->type] ?? 'personal';
        $qualification->delete();

        return Redirect::to(URL::previous() . '#' . $anchor);
    }
}
