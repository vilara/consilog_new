<?php

namespace App\Http\Controllers;

use App\Detail;
use App\Http\Requests\StoreDetails;
use App\Http\Requests\UpdateDetails;
use App\Military;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $user = Auth::user();
        return view ( 'users.create', compact ( 'user') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDetails $request)
    {
       
        $mil = new Military;
        $mil->postograd_id = $request['postograd_id'];
        $mil->situacao = $request['sit'];
        $mil->save();

        $usu = User::find($request['user_id']);
        $detail = new Detail;
        $detail->user_id = $request['user_id'];
        $detail->nome_guerra = $request['nome_guerra'];
       // $detail->postograd_id =$request['postograd_id'];
        $detail->cpf = $request['cpf'];
        $detail->idt =$request['idt'];
        $detail->sexo = $request['sexo'];
        $detail->om_id = $request['om_id'];
        $detail->cargo_id =$request['funcao_id'];
        //$detail->detailable_type = 'militar';
        //$detail->detailable_id =$request['user_id'];
       // $usu->detail()->save($detail);
        $detail->detailable()->associate($mil)->save();
        //$usu->save();
        
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
    public function update(UpdateDetails $request, Detail $detail)
    {
        $usuario = User::find($detail->user_id);
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->save();
        
        $mil = Military::find($detail->detailable_id);
        $mil->postograd_id = $request['postograd_id'];
        $mil->situacao = $request['sit'];
        $mil->save();

        $detail->nome_guerra = $request['nome_guerra'];
        $detail->cpf = $request['cpf'];
        $detail->idt =$request['idt'];
        $detail->sexo = $request['sexo'];
        $detail->om_id = $request['om_id'];
        $detail->cargo_id =$request['funcao_id'];
        $detail->save();
        if (Auth::user()->id == $detail->user_id) {
            return redirect ( '/profile' )->with ( 'success', 'Usuário Editado com sucesso!' );
        }else{
            return redirect ( '/usuarios/'.$detail->user_id )->with ( 'success', 'Usuário Editado com sucesso!' );
        }
        //dd($detail);


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
