<?php

namespace App\Http\Controllers;

use App\IrtaexEfetivo;
use App\IrtaexOii;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Boolean;
use Yajra\DataTables\DataTables;

class EfetivoOiiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\IrtaexOii  $irtaexOii
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, IrtaexOii $oii)
    {
        $efetivos = $oii->irtaexefetivos;
      // dd($efetivos);
        if ($request->ajax()) {

            return DataTables::of($efetivos)
            ->addColumn('postograd', function(IrtaexEfetivo $efetivos){
                return $efetivos->postograd->siglaPg;
            })
            ->make(true);
        }
        return view('irtaex.admin.efetivos.oii.index', compact('oii'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\IrtaexOii  $irtaexOii
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, IrtaexOii $oii)
    {


       // dd($oii);
         $categoria =  $oii->irtaexcategory_id;
        $efetivo = IrtaexEfetivo::where('irtaexcategory_id', $oii->irtaexcategory_id)->get();

   // dd($efetivo[0]->irtaexoiis->contains('oii', "$oii->oii") ? "checked" : "");
        if ($request->ajax()) {
            return DataTables::of($efetivo)
            ->addColumn('action', function (IrtaexEfetivo $efetivo) use ($oii) {
            $s = $efetivo->irtaexoiis->contains('oii', $oii->oii) ? "checked" : "";
            $c = "'Confirma a exlusão do efetivo?'";
            return 
            ' <input type="checkbox" class="editavel" name="vincular" '.$s.' id="vincular" value="teste">';

        })
        ->addColumn('posto',function($efetivo){
          return $efetivo->postograd->siglaPg;
        })
        
      
        ->rawColumns(['action'])
        ->make(true);
    }

        return view('irtaex.admin.efetivos.oii.create', compact('oii', 'categoria', 'efetivo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\IrtaexOii  $irtaexOii
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, IrtaexOii $oii)
    {

        
        if($request->chk == "true"){
            $oii->irtaexefetivos()->attach($request->id,['tipo' => 1]);
        }else{
            $oii->irtaexefetivos()->detach($request->id);
        }
        return "ok";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\IrtaexOii  $irtaexOii
     * @param  \App\IrtaexEfetivo  $irtaexEfetivo
     * @return \Illuminate\Http\Response
     */
    public function show(IrtaexOii $irtaexOii, IrtaexEfetivo $irtaexEfetivo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\IrtaexOii  $irtaexOii
     * @param  \App\IrtaexEfetivo  $irtaexEfetivo
     * @return \Illuminate\Http\Response
     */
    public function edit(IrtaexOii $irtaexOii, IrtaexEfetivo $irtaexEfetivo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\IrtaexOii  $irtaexOii
     * @param  \App\IrtaexEfetivo  $irtaexEfetivo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IrtaexOii $irtaexOii, IrtaexEfetivo $irtaexEfetivo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\IrtaexOii  $irtaexOii
     * @param  \App\IrtaexEfetivo  $irtaexEfetivo
     * @return \Illuminate\Http\Response
     */
    public function destroy(IrtaexOii $irtaexOii, IrtaexEfetivo $irtaexEfetivo)
    {
        //
    }
}
