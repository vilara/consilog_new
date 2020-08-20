<?php

namespace App\Http\Controllers;

use App\Om;
use App\Section;
use App\Telefone;
use App\tipo;
use App\TipoTel;
use App\tipoTelefone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class OmTelefoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Telefone  $telefone
     * @return \Illuminate\Http\Response
     */
    public function index(Om $om, Request $request)
    {
       $telefones = Telefone::where('telefoneable_id', $om->id)->with('section','tipo')->select('telefones.*');

       if ($request->ajax()) {
        return DataTables::of($telefones)
        ->addColumn('action', function (Telefone $telefones) use ($om){
            if (Auth::user()->can('update')) {
                $c = "'Confirma exclusão do telefone?'";
                return '
                <div class="row" style="height: 25px;">
                    <div class="col-md-6 pt-0 h-auto d-inline-block">
                        <a href="' . route('oms.telefones.edit', [$om->id, $telefones->id]) . '" class="" style="color: inherit;" ><center><i class="fas fa-edit"	title="Alterar OM"></i></center></a>            
                    </div>
                    <div class="col-md-6 pt-0 h-auto d-inline-block">
                        <form class="form-group" method="delete" action="'. route('telefone_delete', [$om->id, $telefones->id]) .'" >
                        
                        <button class="btn form-control pt-0 " type="submit" onclick="return confirm('.$c.')"><i class="far fa-trash-alt"></i></button>            
                        </form>
                    </div>
                </div>
                ';
            } else {
                return '<a href="/oms/' . $telefones->id . '/edit" class="" style="color: inherit;" ><i class="fas fa-edit"	title="Alterar OM"></i></a>';
            }
        })
        ->setRowAttr([
            'align' => 'center',
        ])
        ->make(true);
       }
      
       return view('telefones.oms.index', compact ( 'om', 'telefones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Telefone  $telefone
     * @return \Illuminate\Http\Response
     */
    public function create(Om $om)
    {
        $tipoTel = tipo::all();
        $secao = Section::all();
        return view('telefones.oms.create', compact ( 'om', 'tipoTel', 'secao'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Telefone  $telefone
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Om $om)
    {
        $rules = ['ddd' => 'required', 'numero' => 'required', 'tipo_id' => 'required', 'section_id' => 'required'];
        $messages = [
            'ddd.required' => 'Campo obrigatório!',
            'numero.required' => 'Campo obrigatório!',
            'section_id.required' => 'Campo obrigatório!',
            'tipo_id.required' => 'Campo obrigatório!'
        ];

        $this->validate($request, $rules, $messages);
        $telefone = new Telefone();

        $telefone->ddd            =$request->ddd;
        $telefone->numero         =$request->numero;
        $telefone->tipo_id        =$request->tipo_id;
        $telefone->section_id     =$request->section_id;

       //dd($telefone);
        $telefone->telefoneable()->associate($om)->save();
        return redirect ( '/oms' )->with ( 'success', 'Cadastro de telefone de OM inserido!' );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Telefone  $telefone
     * @param  \App\Om  $om
     * @return \Illuminate\Http\Response
     */
    public function show(Om $om, Telefone $telefone)
    {
        return view('telefones.oms.show', compact ( 'om', 'telefone'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Telefone  $telefone
     * @param  \App\Om  $om
     * @return \Illuminate\Http\Response
     */
    public function edit(Om $om, Telefone $telefone)
    {
        $tipoTel = tipo::all();
        $secao = Section::all();
        return view('telefones.oms.edit', compact ( 'om', 'telefone', 'tipoTel', 'secao'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Telefone  $telefone
     * @param  \App\Om  $om
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Om $om, Telefone $telefone)
    {
        $rules = ['ddd' => 'required', 'numero' => 'required', 'tipo_id' => 'required', 'section_id' => 'required'];
        $messages = [
            'ddd.required' => 'Campo obrigatório!',
            'numero.required' => 'Campo obrigatório!',
            'section_id.required' => 'Campo obrigatório!',
            'tipo_id.required' => 'Campo obrigatório!'
        ];

        $this->validate($request, $rules, $messages);

        $telefone->ddd            =$request->ddd;
        $telefone->numero         =$request->numero;
        $telefone->tipo_id        =$request->tipo_id;
        $telefone->section_id     =$request->section_id;

       //dd($telefone);
        $telefone->save();
        return redirect ( 'oms/'.$om->id.'/telefones' )->with ( 'success', 'Telefone editado com sucesso!' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Telefone  $telefone
     * @param  \App\Om  $om
     * @return \Illuminate\Http\Response
     */
    public function destroy(Om $om, Telefone $telefone)
    {
       // dd($telefone);
        $telefone->delete();
        return redirect ( 'oms/'.$om->id.'/telefones')->with ( 'success', 'Telefone excluído com sucesso!' );
    }

     
}
