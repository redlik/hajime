<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MemberDocument;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class MemberDocumentController extends Controller
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
        $document = MemberDocument::create($request->all());
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
     * @param  \App\Models\MemberDocument  $memberDocument
     * @return \Illuminate\Http\Response
     */
    public function show(MemberDocument $memberDocument)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MemberDocument  $memberDocument
     * @return \Illuminate\Http\Response
     */
    public function edit(MemberDocument $memberDocument)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MemberDocument  $memberDocument
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MemberDocument $memberDocument)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MemberDocument  $memberDocument
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $document = MemberDocument::where('id', $id)->first();
        $type = $document->type;
        File::delete(public_path('storage/attachments/'.$document->link));
        $document->delete();

        if ($type === 'Document') {
            return Redirect::to(URL::previous() . "#documents");
        }
        else {
            return Redirect::to(URL::previous()."#forms");
            }
    }
}
