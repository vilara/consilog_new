<?php

namespace App\Http\Controllers;

use App\irtaexCategory;
use App\IrtaexOii;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class IrtaexOiiController extends Controller
{
    public function index(Request $request)
    {
        $oii = IrtaexOii::all();
        if ($request->ajax()) {

            return DataTables::of($oii)
            ->addColumn('action', function (IrtaexOii $oii) {
                $c = "'Confirma a exlusão do OII?'";
                return 
                '<div class="row"  style="height: 25px;">'.
                '<div class="col-md-6 mx-auto" style="height: 25px;">'.
                ' <a href="/oiis/'.$oii->id.'/edit" style="color: inherit;" ><center><i class="fas fa-edit" title="Alterar oii"></i></center></a>'.
                '</div>'.
                '<div class="col-md-6">'.
                '<form class="form-group" method="delete" action="'. route('oii_delete', $oii->id) .'" >'.
                '<button class="btn form-control pt-0 " type="submit" onclick="alert('.$c.');"><i class="far fa-trash-alt"></i></button>'.            
                '</form>'.
                '</div>'.
                '</div>';

            })
            ->editColumn('categoria', function (IrtaexOii $oii) {
                return $oii->irtaexcategory->armamento;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('irtaex.admin.oii.index');
    }

    public function create()
    {
        $category = irtaexCategory::all();
        
        return view('irtaex.admin.oii.create', compact('category'));
    }

    public function store(Request $request)
    {

       // dd($request);
        $rules = [
            'oii' => 'required',
            'tarefa' => 'required',
            'condicao' => 'required',
            'padraminimo' => 'required',
            'irtaexcategory_id' => 'required',
        ];
        $messages = [
            'oii.required' => 'Campo obrigatório.',
            'tarefa.required' => 'Campo obrigatório',
            'condicao.required' => 'Campo obrigatório',
            'padraminimo.required' => 'Campo obrigatório',
            'irtaexcategory_id.required' => 'Campo obrigatório',
        ];

       $this->validate($request, $rules, $messages);
       
        IrtaexOii::create($request->all());
        
        return redirect('oiis');
    }

    public function edit(IrtaexOii $oii)
    {
        $category = irtaexCategory::all();
        return view('irtaex.admin.oii.edit', compact('oii', 'category'));
    }

    public function update(Request $request, IrtaexOii $oii)
    {
        $rules = [
            'oii' => 'required',
            'tarefa' => 'required',
            'condicao' => 'required',
            'padraminimo' => 'required',
            'irtaexcategory_id' => 'required',
        ];
        $messages = [
            'oii.required' => 'Campo obrigatório.',
            'tarefa.required' => 'Campo obrigatório',
            'condicao.required' => 'Campo obrigatório',
            'padraminimo.required' => 'Campo obrigatório',
            'irtaexcategory_id.required' => 'Campo obrigatório',
        ];

        $atributes = $this->validate($request, $rules, $messages);
       
        $oii->update($request->all());
        
        return redirect('oiis');
    }

    public function destroy(IrtaexOii $oii)
    {
        $oii->delete();
        return redirect ( '/oiis' )->with ( 'success', 'OII excluído com sucesso!' );
    }

}
