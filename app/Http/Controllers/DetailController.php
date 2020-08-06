<?php

namespace App\Http\Controllers;

use App\Detail;
use App\Http\Requests\StoreDetails;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DetailController extends Controller
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
    public function store(StoreDetails $request)
    {
        $usu = User::find($request['user_id']);
        $detail = new Detail;

        $detail->nome_guerra = $request['nome_guerra'];
        $detail->cpf = $request['cpf'];
        $detail->idt =$request['idt'];
        $detail->sexo = $request['sexo'];
        $detail->om_id = $request['om_id'];
        $detail->cargo_id =$request['cargo_id'];
        $detail->detailable_type = 'militar';
        $detail->detailable_id =$request['user_id'];
        dd($usu);
        //$usu->save();
        $usu->details()->attach($detail);
        return redirect('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Detail  $detail
     * @return \Illuminate\Http\Response
     */
    public function show(Detail $detail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Detail  $detail
     * @return \Illuminate\Http\Response
     */
    public function edit(Detail $detail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Detail  $detail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Detail $detail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Detail  $detail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Detail $detail)
    {
        //
    }
}
