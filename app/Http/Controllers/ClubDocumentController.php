<?php

namespace App\Http\Controllers;

use App\Models\ClubDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class ClubDocumentController extends Controller
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $document = ClubDocument::create($request->all());
        $fileName = time().'_'.$request->file('link')->getClientOriginalName();
        $filePath = $request->file('link')->storeAs('attachments', $fileName, 'public');

        $document->link = $fileName;
        $document->save();

        if ($document->type === 'Form') {
            return Redirect::to(URL::previous()."#forms");
        } else {
            return Redirect::to(URL::previous()."#documents");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClubDocument  $clubDocument
     * @return \Illuminate\Http\Response
     */
    public function show(ClubDocument $clubDocument)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClubDocument  $clubDocument
     * @return \Illuminate\Http\Response
     */
    public function edit(ClubDocument $clubDocument)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClubDocument  $clubDocument
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClubDocument $clubDocument)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClubDocument  $clubDocument
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $document = ClubDocument::where('id', $id)->first();
        File::delete(public_path('storage/attachments/'.$document->link));
        $document->delete();

        return Redirect::to(URL::previous()."#documents");

    }
}
