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
        // dd($oii);
        if ($request->ajax()) {

            return DataTables::of($oii)
                ->addColumn('action', function (IrtaexOii $oii) {
                    $c = "'Confirma a exlusão do OII?'";
                    return
                        '<div class="row"  style="height: 25px;">' .
                        '<div class="col-md-6 mx-auto" style="height: 25px;">' .
                        ' <a href="/oiis/' . $oii->id . '/edit" style="color: inherit;" ><center><i class="fas fa-edit" title="Alterar oii"></i></center></a>' .
                        '</div>' .
                        '<div class="col-md-6">' .
                        '<form class="form-group" method="delete" action="' . route('oii_delete', $oii->id) . '" >' .
                        '<button class="btn form-control pt-0 " type="submit" onclick="alert(' . $c . ');"><i class="far fa-trash-alt"></i></button>' .
                        '</form>' .
                        '</div>' .
                        '</div>';
                })
                ->addColumn('efetivo', function (IrtaexOii $oii) {
                    if ($oii->irtaexefetivos->count() > 0) {
                        return '
                    <div class="row" style="height: 25px;">
                    <div class="col-md-12 pt-0 h-auto">
                        <a href="' . route('oiis.efetivos.index', $oii->id) . '" class="" style="color: black;" ><center><i class="fas fa-user-friends"	title="Mostrar telefones de OM"></i></center></a>            
                    </div>
                    </div>
                    ';
                    } else {
                        return '
                   <div class="row" style="height: 25px;">
                      <div class="col-md-12 pt-0 h-auto">
                          <a href="' . route('oiis.efetivos.create', $oii->id) . '" class="" style="color: red;" ><center><i class="fas fa-user-friends"	title="Inserir telefone de OM"></i></center></a>            
                      </div>
                   </div>
                   ';
                    }
                })
                ->addColumn('municao', function (IrtaexOii $oii) {

                    if ($oii->vs->count() > 0) {
                        return '
                    <div class="row" style="height: 25px;">
                    <div class="col-md-12 pt-0 h-auto">
                        <a href="'.route('oiis.vs.index', $oii).'" class="" style="color: black;" ><center><i class="fas fa-chess-bishop" title="Mostrar munnições do OII"></i></center></a>
                    </div>
                    </div>
                        ';
                    } else {
                        return '
                    <div class="row" style="height: 25px;">
                    <div class="col-md-12 pt-0 h-auto">
                        <a href="'.route('oiis.vs.create', $oii).'" class="" style="color: red;" ><center><i class="fas fa-chess-bishop" title="Vincular munição"></i></center></a>
                    </div>
                    </div>
                    ';
                    }
                })
                ->editColumn('categoria', function (IrtaexOii $oii) {
                    return $oii->irtaexcategory->armamento;
                })
                ->rawColumns(['action', 'efetivo', 'municao'])
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
        return redirect('/oiis')->with('success', 'OII excluído com sucesso!');
    }
}
