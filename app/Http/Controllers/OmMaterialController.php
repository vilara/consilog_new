<?php

namespace App\Http\Controllers;

use App\Material;
use App\Om;
use Illuminate\Http\Request;

class OmMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Om  $om
     * @return \Illuminate\Http\Response
     */
    public function index(Om $om)
    {
        return view('oms.material.v.index', compact('om'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Om  $om
     * @return \Illuminate\Http\Response
     */
    public function create(Om $om)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Om  $om
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Om $om)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Om  $om
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show(Om $om, Material $material)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Om  $om
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit(Om $om, Material $material)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Om  $om
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Om $om, Material $material)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Om  $om
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function destroy(Om $om, Material $material)
    {
        //
    }
}
