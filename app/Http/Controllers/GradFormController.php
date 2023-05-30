<?php

namespace App\Http\Controllers;

use App\Models\GradForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Storage;
use Illuminate\Support\Facades\Log;

class GradFormController extends Controller
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
        $doc = $request->file('link')->store('public/grad-forms');
        if (Storage::disk("local")->exists($doc)) {
            Log::debug('Saved doc: '.$doc);
            $gradForm = GradForm::create($request->all());
            $file = ltrim($doc, 'public/grad-forms/');
            $gradForm->link = $file;
            $gradForm->save();
        } else {
            Log::debug('Failed doc: '.$doc);
            $request->session()->flash('no-file', 'The file has not been saved, please rename the original document and try again');
            return Redirect::to(URL::previous()."#grads");
        }

        return Redirect::to(URL::previous()."#grads");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GradForm  $gradForm
     * @return \Illuminate\Http\Response
     */
    public function show(GradForm $gradForm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GradForm  $gradForm
     * @return \Illuminate\Http\Response
     */
    public function edit(GradForm $gradForm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GradForm  $gradForm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GradForm $gradForm)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GradForm  $gradForm
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gradForm = GradForm::find($id);
        File::delete(public_path('storage/grad-forms/'.$gradForm->link));
        $gradForm->delete();

        return Redirect::to(URL::previous()."#grads");

    }
}
