<?php

namespace App\Http\Controllers;

use App\Source;
use Illuminate\Http\Request;

class SourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Source::all(), 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $req
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $src = Source::create($req->only('source'));
        return response()->json($src, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Source $source
     * @return \Illuminate\Http\Response
     */
    public function show(Source $source)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Source $source
     * @return \Illuminate\Http\Response
     */
    public function edit(Source $source)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Source $source
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Source $source)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Source $source
     * @return \Illuminate\Http\Response
     */
    public function destroy(Source $source)
    {
        //
    }
}
