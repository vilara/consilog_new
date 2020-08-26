<?php

namespace App\Http\Controllers;

use App\Material;
use App\V;
use Illuminate\Http\Request;

class ClasseVMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\V  $v
     * @return \Illuminate\Http\Response
     */
    public function index(V $v, Request $request)
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\V  $v
     * @return \Illuminate\Http\Response
     */
    public function create(V $v)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\V  $v
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, V $v)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\V  $v
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show(V $v, Material $material)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\V  $v
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit(V $v, Material $material)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\V  $v
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, V $v, Material $material)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\V  $v
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function destroy(V $v, Material $material)
    {
        //
    }
}
