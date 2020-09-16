<?php

namespace App\Http\Controllers;

use App\irtaexCategory;
use App\IrtaexEfetivo;
use App\Om;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Calculation\Category;
use Yajra\DataTables\DataTables;

class OmEfetivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Om  $om
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $oms = Om::all();
      
       
        $categorias = irtaexCategory::all();
       


        if ($request->ajax()) { 

            $efetivo = irtaexCategory::where('id',$request->categoria)->get()->map(function ($item){
            return $item->IrtaexEfetivo;
            })->collapse();
            $om = $request->om;

            return DataTables::of($efetivo)
            ->addColumn('posto',function($efetivo){
                return $efetivo->postograd->siglaPg;
              })
              ->addColumn('efetivo',function($efetivo) use ($om){
                return 
                '<input type="text" class="form-control form-control-sm id="efetivo" name="efetivo" value="'.
                $efetivo->oms->where('id', $om)->sum('pivot.efetivo').
                '">';
              })
              ->setRowClass(function ($efetivo) use ($om) {
                if ($efetivo->oms->where('id', $om)->sum('pivot.efetivo') == 0) {
                    return 'text-center table-danger';
                } else {
                    return 'text-center';
                }
            })
            ->rawColumns(['efetivo'])
            ->make(true);
    }
        return view('irtaex.om.efetivo.index', compact('oms', 'categorias'));
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
     * @param  \App\IrtaexEfetivo  $irtaexEfetivo
     * @return \Illuminate\Http\Response
     */
    public function show(Om $om, IrtaexEfetivo $irtaexEfetivo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Om  $om
     * @param  \App\IrtaexEfetivo  $irtaexEfetivo
     * @return \Illuminate\Http\Response
     */
    public function edit(Om $om, IrtaexEfetivo $irtaexEfetivo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Om  $om
     * @param  \App\IrtaexEfetivo  $irtaexEfetivo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Om $om, IrtaexEfetivo $irtaexEfetivo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Om  $om
     * @param  \App\IrtaexEfetivo  $irtaexEfetivo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Om $om, IrtaexEfetivo $irtaexEfetivo)
    {
        //
    }
}
