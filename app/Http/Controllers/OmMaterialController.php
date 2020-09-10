<?php

namespace App\Http\Controllers;

use App\IrtaexOii;
use App\Material;
use App\Om;
use App\V;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Yajra\DataTables\DataTables;

class OmMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Om  $om
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $v1 = V::all();
        $v= V::all()->filter(function($v){
            
            return $v->material;
        });
        $om = Om::all()->filter(function($om){
             return $om->id == 15;
        })->first()->materials->filter(function($value){
            return $value->materialable_type == 'v';
        });


        // $rr = $om->first()->materials->filter(function($value){
        //     return $value->materialable_type == 'v';
        // })
        $material = $om->groupBy('nee');
        // dd($v[0]->material->oms->filter(function($value){
        //    return $value->id == 13;
        // }));
        $mytime = Carbon::now();

        if ($request->ajax()) {

            return DataTables::of($material)
            ->addColumn('nee', function ($material) {
                return $material->first()->materialable->modelo;})            
            ->make();
        }



        return view('oms.material.v.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Om  $om
     * @return \Illuminate\Http\Response
     */
    public function create(Om $om)
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Om  $om
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show(Om $om, Material $material)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Om  $om
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit(Om $om, Material $material)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Om  $om
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Om $om, Material $material)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Om  $om
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function destroy(Om $om, Material $material)
    {
        //
    }


    public function SomaMunicaoOm(Om $om){

        $colecao = $om->materialsTot->groupBy(function ($item, $key) {
        return $item->nee;
        })
        ->map(function ($item, $key) {
        return $item->sum('pivot.qtde');
        }); 

        return $colecao;
        
    }

    public function SomaMunicaoTotalNee($nee){
        $material = Material::with('oms')->get();
        $colecao = $material->where('nee',$nee)
        ->first()
        ->oms->groupBy(function ($item, $key) {
            return $item->nee;
            })
        ->map(function ($item1, $key) {
            return $item1->sum('pivot.qtde');
            });
         // dd($colecao->first());
        return $colecao->first();
        
    }

    public function SomaMunicaoTotalNeeOM(Om $om, $nee){
      
       return $om->materialsTot->where('nee',$nee)->first()->oms->sum('pivot.qtde');
        
    }

    public function SomaMunicaoTotalNeeOii($nee){
        $oii = IrtaexOii::all();
        $oiiv = $oii->groupBy('oii'); 
      foreach ($oiiv as $rr) {
         echo $rr[0]->oii ." - " . $rr[0]->vs->first()->id ." </br> ";
      }
   
        $material = Material::with('oms')->get();
        $colecao = $material->where('nee',$nee)
        ->first()
        ->oms->groupBy(function ($item, $key) {
            return $item->nee;
            })
        ->map(function ($item1, $key) {
            return $item1->sum('pivot.qtde');
            });
         // dd($colecao->first());
        return $colecao->first();
        
    }

    public function SomaMunicaoTotalGeral(){
        $geral = 0;
        $materials = Material::with('oms')->get();
        foreach ($materials as $material) {
        $tot =  $material->oms
        ->groupBy(function ($item, $key) {
            return $item->nee;
            })
        ->map(function ($item1, $key) {
            return $item1->sum('pivot.qtde');
            });
        $geral = $geral + $tot->first();
        }
       
        return $geral;
    }
}
