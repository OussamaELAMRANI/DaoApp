<?php

namespace App\Http\Controllers;

use App\Educators;
use Illuminate\Http\Request;

class EducatorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Educators::all());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newEducator = Educators::create(request(['educator1_name', 'educator2_name']));

        return response()->json(['educators' => $newEducator], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Educators $educators
     * @return \Illuminate\Http\Response
     */
    public function show(Educators $educators)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Educators $educators
     * @return \Illuminate\Http\Response
     */
    public function edit(Educators $educators)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Educators $educators
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Educators $educators)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Educators $educators
     * @return \Illuminate\Http\Response
     */
    public function destroy(Educators $educators)
    {
        //
    }
}
