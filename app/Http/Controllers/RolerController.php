<?php

namespace App\Http\Controllers;

use App\Roler;
use Illuminate\Http\Request;

class RolerController extends Controller
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
        $data = $this->validateRequest();

        Roler::create([
            'name' => request('name'),
            'label' => request('label')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Roler  $roler
     * @return \Illuminate\Http\Response
     */
    public function show(Roler $roler)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Roler  $roler
     * @return \Illuminate\Http\Response
     */
    public function edit(Roler $roler)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Roler  $roler
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Roler $roler)
    {
        $data = $this->validateRequest();
        $roler->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Roler  $roler
     * @return \Illuminate\Http\Response
     */
    public function destroy(Roler $roler)
    {
        //
    }

    /**
     * @return array
     */
    protected function validateRequest(): array
    {
        return request()->validate([
            'name' => 'required',
            'label' => 'required',

        ]);
    }
}
