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

            if (isset($request->om)) {
                $c = $request->om;
            } else {
                $cmdo = Comando::whereIn('id', $request->cmdo)->get();
                $c = $cmdo->first()->getOmdsId();
            }

            $municao = $this->getMaterialVByOm(collect($c), "v", "");
            
            if(isset($request->val)){
                $municao = $this->getMaterialVByOm(collect($c), "v", Carbon::now()->addYears($request->val)->toDateString());
            }


            return DataTables::of($municao)
                ->addColumn('id', function ($municao) {
                    return $municao->first()->id;
                })
                ->addColumn('nome', function ($municao) {
                  return $municao->first()->material->nome;
                })
                ->addColumn('modelo', function ($municao) {
                    return $municao->first()->modelo;
                })
                ->addColumn('qtde', function ($municao) use ($c,$request){
                    if(isset($request->val)){
                        return $municao->first()->material->GetTotOmCodValidateMenorQue(collect($c), Carbon::now()->addYears($request->val)->toDateString());
                    }else{

                        return $municao->first()->material->GetTotOmCod(collect($c));
                    }

                })
                ->addColumn('validade', function ($municao) use ($c) {
                     $date = date('d/m/Y', strtotime($municao->first()->material->GetMinValCod(collect($c))));
                    if (strtotime($municao->first()->material->GetMinValCod(collect($c))) < strtotime(Carbon::now())) {
                        $date .= '<span class="badge badge-info right ml-2">' . $municao->first()->material->GetTotOmCodValidate(collect($c), $municao->first()->material->GetMinValCod(collect($c)))   . '</span>';
                    }
                    return $date;
                })
                ->addColumn('nee', function ($material) {
                   // return $material->sum('pivot.qtde');
                })
                ->setRowClass(function ($municao)  use ($c) {
                    if (strtotime($municao->first()->material->GetMinValCod(collect($c))) < strtotime(Carbon::now())) {
                         return 'text-center table-danger';
                     } else {
                        return 'text-center';
                     }
                })
                ->rawColumns(['validade'])
                ->make();
        }
        return view('oms.material.v.index', compact('omg', 'gcmdos'));
    }


    public function indexChart(Request $request)
    {
        return $this->GetOmTotal($request);
    }


    public function GetOmTotal(Request $request)
    {

        if ($request->ajax()) {

            $nomeOM = collect([]);
            $dados = collect([]);
            $om = collect([]);
            $m[] = '';
            $matcalibre = V::whereIn('id', $request->mun)->with('material')->get();


            if (isset($request->om)) {
                $om = $request->om;
                for ($i = 0; $i < count($om); $i++) {

                    $nomeOm = Om::where('id', $om[$i])->get()->first();
                    $nomeOM->push($nomeOm->siglaOM);
                    unset($m);
                    for ($ii = 0; $ii < $matcalibre->count(); $ii++) {
                        $q =  $matcalibre[$ii]->material->oms->filter(function ($iten) use ($nomeOm) {
                            return $iten->id == $nomeOm->id;
                        })->sum('pivot.qtde');
                        $m[] = $q;
                    }

                    $dados->push($m);
                }
            } else {
                $cmdo = $request->cmdo;
              
                for ($i = 0; $i < count($cmdo); $i++) {

                    $nomeOm = Comando::where('id', $cmdo[$i])->get()->first();
                    $nomeOM->push($nomeOm->siglaCmdo);

                    $c = $nomeOm->getOmdsId();
                    unset($m);
                     for ($ii = 0; $ii < $matcalibre->count(); $ii++) {

                        $q =  $matcalibre[$ii]->material->oms->whereIn('id',$c)->sum('pivot.qtde');
                        $m[] = $q;

                    }
                    $dados->push($m);
                }
            }


            $r[] = [$matcalibre, $nomeOM, $dados];


            return $r;
        }

        $omg = Om::all()->sortBy('siglaOM');
        foreach ($omg as $rr) {
            $t[] = $rr->id;
        }

        $gcmdos = Comando::all()->sortBy('siglaCmdo');
        foreach ($gcmdos as $gcmdo) {
            $g[] = $gcmdo->id;
        }

        $mun =  V::all();


        return view('oms.material.v.chartindex', compact('omg', 'gcmdos', 'mun'));
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

    public function getMaterialVByOm(Collection $om, $classe, $validade){

          if(count($om) > 0){
              $material = Om::whereIn('id', $om)->get()->map(function ($item)  use($validade,$classe) {
                return $item->materials->filter(function ($value) use($validade,$classe) {
                    if($validade != ''){
                        return $value->materialable_type ==  $classe AND $value->pivot->validade <= $validade;
                    }else{
                        return $value->materialable_type ==  $classe;
                    }
                });
            })->collapse(); 
          }else{
            $material = Om::all()->map(function ($item)  use($validade,$classe) {
                return $item->materials->filter(function ($value) use($validade,$classe) {
                    if($validade != ''){
                        return $value->materialable_type ==  $classe AND $value->pivot->validade <= $validade;
                    }else{
                        return $value->materialable_type ==  $classe;
                    }
                });
            })->collapse(); 
          }
         

            $municao = $material->map(function($item){
                return $item->materialable;
            });

            $mun = $municao->groupBy('codigo');

        return $mun;
        
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
