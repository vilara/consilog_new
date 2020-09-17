<?php

namespace App\Http\Controllers;

use App\IrtaexOii;
use App\Material;
use App\V;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class OiiVController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\V  $v
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, IrtaexOii $oii)
    {

        $municoes = $oii->vs;
        // dd($efetivos);
          if ($request->ajax()) {
  
              return DataTables::of($municoes)
              ->addColumn('nome', function ($municoes) {
                 return $municoes->material->nome;
              })

              ->addColumn('qtde', function ($municoes) use($oii) {
                return
                '<input type="number" class="form-control form-control-sm col-sm-4"  id="efetivo" name="efetivo" value="' .
                 $municoes->irtaexoiis->where('oii',$oii->oii)->first()->pivot->quantidade.
                 '">';
             })
             ->rawColumns(['qtde'])

             
             
              ->make(true);
          }

        return view('irtaex.admin.oii.v.index', compact('oii'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\V  $v
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, IrtaexOii $oii)
    {


      
        $material = Material::where("materialable_type", "v")->get();

       // dd($oii->vs[0]);

   // dd($efetivo[0]->irtaexoiis->contains('oii', "$oii->oii") ? "checked" : "");
        if ($request->ajax()) {

        return DataTables::of($material)
        ->addColumn('nome', function ($material) {
            return $material->nome;
         })
         ->addColumn('modelo', function ($material) {
            return $material->materialable->modelo;
         })
         ->addColumn('action', function ($material) use ($oii) {
            $s = $oii->vs->contains('id', $material->id) ? "checked" : "";
            return 
            ' <input type="checkbox" class="editavel" name="vincular" '.$s.' id="vincular" value="teste">';

        })
        ->make(true);
    }

        return view('irtaex.admin.oii.v.create', compact('oii'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\V  $v
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, IrtaexOii $oii)
    {
        if($request->chk == "true"){
          $oii->vs()->attach($request->id,['quantidade' => 0]);
            return "ok";
        }elseif($request->chk == "false"){
        $oii->vs()->detach($request->id);
            return "ok";
        }

        $qtde = collect($request->arr);
        $vv = collect($request->vs);
        for ($i = 0; $i < $qtde->count(); $i++) {
            $oii->vs()->detach($vv[$i]);
            $oii->vs()->attach($vv[$i], ['quantidade' => $qtde[$i]]);
        }

        return "Quantidade de munições atualiza com sucesso!";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\V  $v
     * @param  \App\IrtaexOii  $irtaexOii
     * @return \Illuminate\Http\Response
     */
    public function show(V $v, IrtaexOii $irtaexOii)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\V  $v
     * @param  \App\IrtaexOii  $irtaexOii
     * @return \Illuminate\Http\Response
     */
    public function edit(V $v, IrtaexOii $irtaexOii)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\V  $v
     * @param  \App\IrtaexOii  $irtaexOii
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, V $v, IrtaexOii $irtaexOii)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\V  $v
     * @param  \App\IrtaexOii  $irtaexOii
     * @return \Illuminate\Http\Response
     */
    public function destroy(V $v, IrtaexOii $irtaexOii)
    {
        //
    }
}
