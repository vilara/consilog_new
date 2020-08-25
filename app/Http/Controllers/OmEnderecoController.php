<?php

namespace App\Http\Controllers;

use App\Endereco;
use App\Om;
use Illuminate\Http\Request;

class OmEnderecoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Om  $om
     * @return \Illuminate\Http\Response
     */
    public function index(Om $om)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Om  $om
     * @return \Illuminate\Http\Response
     */
    public function create(Om $om)
    {
        return view('enderecos.oms.create', compact ( 'om'));
       // dd($om);
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
        $rules = [
            'cep' => 'required',
            'rua' => 'required',
            'numeroEndereco' => 'required',
            'cidade' => 'required',
            'bairro' => 'required',
            'estado' => 'required'
        ];
        $messages = [
            'cep.required' => 'Campo obrigatório.',
            'rua.required' => 'Campo obrigatório',
            'numeroEndereco.required' => 'Campo obrigatório',
            'cidade.required' => 'Campo obrigatório',
            'bairro.required' => 'Campo obrigatório',
            'estado.required' => 'Campo obrigatório',            
        ];

        $this->validate($request, $rules, $messages);
        $endereco = new Endereco();

        $endereco->cep            =$request->cep;
        $endereco->rua            =$request->rua;
        $endereco->numeroEndereco =$request->numeroEndereco;
        $endereco->complemento    =$request->complemento;
        $endereco->cidade         =$request->cidade;
        $endereco->bairro         =$request->bairro;
        $endereco->estado         =$request->estado;

       //dd($endereco);
        $endereco->enderecoable()->associate($om)->save();
        return redirect ( '/oms' )->with ( 'success', 'Cadastro de endereço de OM inserido!' );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Om  $om
     * @param  \App\Endereco  $endereco
     * @return \Illuminate\Http\Response
     */
    public function show(Om $om, Endereco $endereco)
    {
        return view('enderecos.oms.show', compact ( 'om', 'endereco'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Om  $om
     * @param  \App\Endereco  $endereco
     * @return \Illuminate\Http\Response
     */
    public function edit(Om $om, Endereco $endereco)
    {
        return view('enderecos.oms.edit', compact ( 'om', 'endereco'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Om  $om
     * @param  \App\Endereco  $endereco
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Om $om, Endereco $endereco)
    {
        $rules = ['cep' => 'required'];
        $messages = ['cep.required' => 'Campo obrigatório.',];

        $this->validate($request, $rules, $messages);
        
        $endereco->cep            =$request->cep;
        $endereco->rua            =$request->rua;
        $endereco->numeroEndereco =$request->numeroEndereco;
        $endereco->complemento    =$request->complemento;
        $endereco->cidade         =$request->cidade;
        $endereco->bairro         =$request->bairro;
        $endereco->estado         =$request->estado;

       //dd($endereco);
        $endereco->save();

        return redirect ( '/oms' )->with ( 'success', 'Endereço de OM atualizado!' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Om  $om
     * @param  \App\Endereco  $endereco
     * @return \Illuminate\Http\Response
     */
    public function destroy(Om $om, Endereco $endereco)
    {
        //
    }
}
