<?php

namespace App\Http\Controllers;

use App\Charts\MaterialOmChart;
use App\IrtaexOii;
use App\Material;
use App\Om;
use App\V;
use App\Comando;
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

        $omg = Om::all()->sortBy('siglaOM');
        foreach ($omg as $rr) {
            $t[] = $rr->id;
        }
       
        $gcmdos = Comando::all()->sortBy('siglaCmdo');
        foreach ($gcmdos as $gcmdo) {
            $g[] = $gcmdo->id;
        }

        if ($request->ajax()) {


         
               if(isset($request->om)){
                    $om = Om::whereIn('id', $request->om)->get()->map(function ($item) {
                    return $item->materials->filter(function ($value) {
                        return $value->materialable_type == 'v';
                    });;
                })->collapse();
               }else{

                $cmdo = Comando::whereIn('id', $request->cmdo)->get();
                 $c = $cmdo->first()->getOmdsId();

                $om = Om::whereIn('id', $c)->get()->map(function ($item) {
                    return $item->materials->filter(function ($value) {
                        return $value->materialable_type == 'v';
                    });;
                })->collapse();

               }


               
          
            
            $material = $om->groupBy('nee');

            return DataTables::of($material)
                ->addColumn('id', function ($material) {
                    return $material->first()->id;
                })
                ->addColumn('nome', function ($material) {
                    return $material->first()->nome;
                })
                ->addColumn('modelo', function ($material) {
                    return $material->first()->materialable->modelo;
                })
                ->addColumn('qtde', function ($material) {
                    return $material->sum('pivot.qtde');
                })
                ->addColumn('validade', function ($material) {
                    $date = date('d/m/Y', strtotime($material->min('pivot.validade')));
                    if (strtotime($material->min('pivot.validade')) < strtotime(Carbon::now())) {

                        $date .= '<span class="badge badge-info right ml-2">' . ($material->where('pivot.validade', $material->min('pivot.validade')))->sum('pivot.qtde')  . '</span>';
                    }
                    return  $date;
                })
                ->setRowClass(function ($material) {
                    if (strtotime($material->min('pivot.validade')) < strtotime(Carbon::now())) {
                        return 'text-center table-danger';
                    } else {
                        return 'text-center';
                    }
                })
                ->rawColumns(['validade'])
                ->make();
        }
        return view('oms.material.v.index', compact('omg','gcmdos'));
    }


    public function indexChart(Request $request)
    {

        $omg = Om::all()->sortBy('siglaOM');
        foreach ($omg as $rr) {
            $t[] = $rr->id;
        }
       
        $gcmdos = Comando::all()->sortBy('siglaCmdo');
        foreach ($gcmdos as $gcmdo) {
            $g[] = $gcmdo->id;
        }

       
      

    
        return view('oms.material.v.chartindex', compact('omg','gcmdos'));
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


    public function SomaMunicaoOm(Om $om)
    {

        $colecao = $om->materialsTot->groupBy(function ($item, $key) {
            return $item->nee;
        })
            ->map(function ($item, $key) {
                return $item->sum('pivot.qtde');
            });

        return $colecao;
    }

    public function SomaMunicaoTotalNee($nee)
    {
        $material = Material::with('oms')->get();
        $colecao = $material->where('nee', $nee)
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

    public function SomaMunicaoTotalNeeOM(Om $om, $nee)
    {

        return $om->materialsTot->where('nee', $nee)->first()->oms->sum('pivot.qtde');
    }

    public function SomaMunicaoTotalNeeOii($nee)
    {
        $oii = IrtaexOii::all();
        $oiiv = $oii->groupBy('oii');
        foreach ($oiiv as $rr) {
            echo $rr[0]->oii . " - " . $rr[0]->vs->first()->id . " </br> ";
        }

        $material = Material::with('oms')->get();
        $colecao = $material->where('nee', $nee)
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

    public function SomaMunicaoTotalGeral()
    {
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
