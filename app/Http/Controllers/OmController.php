<?php

namespace App\Http\Controllers;

use App\Comando;
use App\Endereco;
use App\Http\Requests\UpdateOms;
use App\Om;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Yajra\DataTables\DataTables;

class OmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $om = Om::all()->filter(function($om) {
            if(Auth::user()->can('view', $om)){
                return $om;
            }
          });

        if ($request->ajax()) {
            return DataTables::of($om)
            ->addColumn('action', function (Om $om) {
                if (Auth::user()->can('update')) {
                    $c = "'Confirma exclusão da OM?'";
                    $d = "'DELETE'";
                    return '
                    <div class="row" style="height: 25px;">
                        <div class="col-md-6 pt-0 h-auto d-inline-block">
                            <a href="/oms/' . $om->id . '/edit" class="" style="color: inherit;" ><center><i class="fas fa-edit"	title="Alterar OM"></i></center></a>            
                        </div>
                        <div class="col-md-6 pt-0 h-auto d-inline-block">
                            <form class="form-group" method="delete" action="'. route('om_delete', $om->id) .'" >
                            
                            <button class="btn form-control pt-0 " type="submit" onclick="return confirm('.$c.')"><i class="far fa-trash-alt"></i></button>            
                            </form>
                        </div>
                    </div>
                    ';
                } else {
                    return '<a disabled="disabled"  href="/oms/' . $om->id . '/edit" class="" style="color: inherit;" ><i class="fas fa-edit"	title="Alterar OM"></i></a>';
                }
            })
            ->addColumn('endereco', function (Om $om) {
            
                if($om->enderecos->count() > 0){
                     return '
                     <div class="row" style="height: 25px;">
                     <div class="col-md-12 pt-0 h-auto">
                         <a href="'. route('oms.enderecos.show', [$om->id, $om->enderecos[0]->id]).'" class="" style="color: black;" ><center><i class="fas fa-home"	title="Mostrar endereco de OM"></i></center></a>            
                     </div>
                     </div>
                     ';
                }else{
                    return '
                    <div class="row" style="height: 25px;">
                       <div class="col-md-12 pt-0 h-auto">
                           <a href="'. route('oms.enderecos.create', $om->id).'" class="" style="color: red;" ><center><i class="fas fa-home"	title="Inserir endereco de OM"></i></center></a>            
                       </div>
                    </div>
                    ';
                }
            })
            ->addColumn('gcmdo', function (Om $om) {
                foreach ($om->comandosOmds as $cmdo) {
                    return '<a href="'.route('comandos.show',$cmdo->id).'" style="color: inherit;">'. $cmdo->siglaCmdo .'</a>';
                }
                })
                
            ->addColumn('telefone', function (Om $om) {
            
                if($om->telefones->count() > 0){
                     return '
                     <div class="row" style="height: 25px;">
                     <div class="col-md-12 pt-0 h-auto">
                         <a href="'. route('oms.telefones.index', [$om->id]).'" class="" style="color: black;" ><center><i class="fas fa-phone"	title="Mostrar telefones de OM"></i></center></a>            
                     </div>
                     </div>
                     ';
                }else{
                    return '
                    <div class="row" style="height: 25px;">
                       <div class="col-md-12 pt-0 h-auto">
                           <a href="'. route('oms.telefones.create', $om->id).'" class="" style="color: red;" ><center><i class="fas fa-phone"	title="Inserir telefone de OM"></i></center></a>            
                       </div>
                    </div>
                    ';
                }
            })
            ->editColumn('nomeOm', function(Om $om) {
                return '<a href="'.route('oms.show',$om->id).'" style="color: inherit;">'. $om->nomeOm .'</a>';
            })
            ->rawColumns(['nomeOm', 'action', 'endereco', 'telefone', 'gcmdo'])
            ->make(true);
        }
        return view('oms.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('oms.create');
    }

    public function CreateSubordinacaoOm($id)
    {
    	$om = Om::find($id);
    	$cmdo = Comando::all();
    	return view ( 'oms.createSubordinacao', compact ( 'om','cmdo') );
    }

    public function storeSubordinacaoOm(Request $request)
    {
        $rules = ['cmdo' => 'required', 'omds' => 'required'];
        $messages = [
            'cmdo.required' => 'Campo obrigatório!',
            'omds.required' => 'Campo obrigatório!',
        ];

        $this->validate($request, $rules, $messages);
    	
    	$om = Om::find($request->id);
    	$cmdo = Comando::find($request->cmdo);
    	//dd($request);
    	$om->comandos()->attach([$cmdo->id => ['omds' => $request->omds]]);
    	
    	return redirect ( '/oms' )->with ( 'success', 'Subordinação inserida com sucesso!' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UpdateOms $request)
    {
        $om = new Om;
        $om->nomeOm = $request->nomeOm;
        $om->siglaOM = $request->siglaOM;
        $om->codom = $request->codom;
        $om->codug = $request->codug;
       
       $om->save();
       return redirect ( '/oms/' )->with ( 'success', 'OM incluída com sucesso!' );

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Om  $om
     * @return \Illuminate\Http\Response
     */
    public function show(Om $om)
    {
        return view('oms.show', compact('om'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Om  $om
     * @return \Illuminate\Http\Response
     */
    public function edit(Om $om)
    {
        return view('oms.edit', compact('om'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Om  $om
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Om $om)
    {
        $om->nomeOm = $request->nomeOm;
        $om->siglaOM= $request->siglaOM;
        $om->codom  = $request->codom;
        $om->codug  = $request->codug;
        $om->save();
        
        return redirect ( '/oms/' )->with ( 'success', 'OM editada com sucesso!' );
       // return back()->with('message', 'Record Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Om  $om
     * @return \Illuminate\Http\Response
     */
    public function destroy(Om $om)
    {
        $om->delete();
        return redirect ( '/oms' )->with ( 'success', 'OM excluída com sucesso!' );
    }

    public function isSubordinada(Om $om){
        $cmdo = Comando::find(1);
       // dd($cmdo);
        if ($om->comandosOmds()->contains('id', $cmdo->id)) {
          return true; 
        }else{
            return false;   
        }
        
   }


 
}