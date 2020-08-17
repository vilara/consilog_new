<?php

namespace App\Http\Controllers;

use App\Comando;
use App\Http\Requests\UpdateComandos;
use App\Om;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class ComandoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $comando = Comando::all();
        if ($request->ajax()) {

            return DataTables::of($comando)
            ->addColumn('action', function (Comando $comando) {
                $c = "'Confirma exclusão da OM?'";
                return '
                <div class="row"  style="height: 25px;">
                <div class="col-md-6 mx-auto" style="height: 25px;">
                    <a href="/comandos/' . $comando->id . '/edit" style="color: inherit;" ><center><i class="fas fa-edit"	title="Alterar comando"></i></center></a>            
                </div>
                <div class="col-md-6">
                <form class="form-group" method="delete" action="'. route('cmdo_delete', $comando->id) .'" >
                <button class="btn form-control pt-0 " type="submit" onclick="return confirm('.$c.')"><i class="far fa-trash-alt"></i></button>            
                </form>
                </div>
            </div>'
                ;
            })
            ->addColumn('omds', function (Comando $comando) {
                return 
                '<div class="row"  style="height: 25px;">
                <div class="col-md-12 mx-auto" style="height: 25px;">
                <a href="/comandos/subordinados/' . $comando->id . '" style="color: inherit;" ><center><i class="fas fa-external-link-alt"	title="Mostrar OMDS"></i></center></a> 
                </div>
                </div>'
                ;
            })
            ->editColumn('nomeCmdo', function(Comando $comando) {
                return '<a href="'.route('comandos.show',$comando->id).'" style="color: inherit;">'. $comando->nomeCmdo .'</a>';
            })
            ->rawColumns(['nomeCmdo', 'action', 'omds'])
            ->make(true)
            
            ;
           
        }
         return view('comandos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('comandos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UpdateComandos $request)
    {
        $comando = new Comando;
        $comando->nomeCmdo = $request->nomeCmdo;
        $comando->siglaCmdo = $request->siglaCmdo;
        $comando->codomOm = $request->codomOm;
        $comando->codugOm = $request->codugOm;
       
       $comando->save();
       return redirect ( '/comandos/' )->with ( 'success', 'Comando incluído com sucesso!' );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comando  $comando
     * @return \Illuminate\Http\Response
     */
    public function show(Comando $comando)
    {
        return view('comandos.show', compact('comando'));
    }

    public function showSubordinadas($id)
    {

      // Om::with('comandos')->where('comandos.id',1)->select(['id', 'nomeOm']);
         $cmdsu = Comando::find($id);
     
      // Om::with('comandos')->where('comandos.id',1)->select(['id', 'nomeOm']);
      // $om = Om::with('comandos')->where('oms.id',3)->select(['oms.*', 'comandos.*'])->get();
     // dd($om[0]->id);
      // dd($om) ;
      // dd($data);
        
        // dd($data);
       // if ($request->ajax()) {
       //     return DataTables::of($om)->make(true);
//
     //   }
    	//$cmdsu = Comando::find($id);
    	return view('comandos.showSubordinadas', compact('cmdsu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comando  $comando
     * @return \Illuminate\Http\Response
     */
    public function edit(Comando $comando)
    {
        return view('comandos.edit', compact('comando'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comando  $comando
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comando $comando)
    {
        $comando->nomeCmdo = $request->nomeCmdo;
        $comando->siglaCmdo= $request->siglaCmdo;
        $comando->codomOm  = $request->codomOm;
        $comando->codugOm  = $request->codugOm;
        $comando->save();
        
        return redirect ( '/comandos/' )->with ( 'success', 'Comando editada com sucesso!' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comando  $comando
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comando $comando)
    {
        $comando->delete();
        return redirect ( '/comandos' )->with ( 'success', 'Comando excluído com sucesso!' );
    }
}
