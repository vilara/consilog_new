<?php

namespace App\Http\Controllers;

use App\Comando;
use App\irtaexCategory;
use App\IrtaexEfetivo;
use App\IrtaexOii;
use App\Om;
use App\V;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\MaterialOmTotalController;

class IrtaexController extends Controller
{

    public function ResumoEfeTotOm(Request $request)
    {
        if ($request->ajax()) {

            $oiis = IrtaexOii::where('irtaexcategory_id', $request->category)->get();

            if (!isset($request->oii)) {
                $o = $oiis->map(function ($value) {
                    return $value->oii;
                })->all();
            } else {
                $o = $request->oii;
            }

            $oo = $oiis->first()->where('irtaexcategory_id', $request->category)->whereIn('oii', $o)->get(); // retorna um objeto da Classe Irtaexoii
            return DataTables::of($oo)
                ->editColumn('id', function ($oo) {
                    return $oo->oii;
                })
                ->editColumn('soma', function ($oo) use ($request) {
                    if(!isset($request->efetivo)){
                        return $this->SomaEfetivoOiiOm($oo, $request->om); // $oo é um objeto da Classe Irtaexoii
                    }else{
                        return $request->efetivo; // $oo é um objeto da Classe Irtaexoii
                    }
                })
                ->make(true);
        }
    }

    public function ResumoMunTotOm(Request $request)
    {

        if ($request->ajax()) {

            $oiis = IrtaexOii::where('irtaexcategory_id', $request->category)->get();

            if (!isset($request->oii)) {
                $o = $oiis->map(function ($value) {
                    return $value->oii;
                })->all();
            } else {
                $o = $request->oii;
            }

            $oo = $oiis->first()->where('irtaexcategory_id', $request->category)->whereIn('oii', $o)->get(); // retorna um objeto da Classe Irtaexoii
            $municao = $oo->map(function ($value) {
                return $value->vs;
            })->collapse()->groupBy('nee');
            $ommm = Om::where('id', $request->om)->get();
            return DataTables::of($municao)
                ->editColumn('id', function ($municao) {
                    return $municao->first()->material->nome . " " . $municao->first()->modelo;
                })
                ->editColumn('estoque', function ($municao) use ($ommm, $request, $o) {

                     $estoque = $municao->first()->material->oms->filter(function ($iten) use ($ommm) {
                        return $iten->id == $ommm[0]->id;
                    })->sum('pivot.qtde');
                     
                     $necc = $this->GetSomaMunNecOiiCat($request->category, $municao->first()->id, $ommm[0]->id, $o,$request->efetivo);
                     if($necc > 0){

                         $perr = number_format($estoque * 100 / $necc, 0, '', '') . " %";
                     }else{
                         $perr = -1;
                     }
                    if ($perr < 0) {
                        $perr = '0 %';
                    }
                    if ($perr > 100) {
                        $perr = '100 %';
                    }
                    if ($perr == '0 %') {
                        $c = 'class="bg-danger disabled color-palette"';
                    } elseif ($perr == '100 %') {
                        $c = 'class="bg-success disabled color-palette"';
                    } else {
                        $c = 'class="bg-warning disabled color-palette"';}

                    return '<div ' . $c . '>' .$estoque  . '  <span class="badge badge-info right ml-2 mb-1">' . $perr . '</span></div>';
                })
                ->editColumn('mun_nec', function ($municao) use ($ommm, $request, $o) {


                    //     $per = $mat->index($municao->material) + $coll[$municao->material->nee];
                    //     $perr = number_format($per * 100 / $coll[$municao->material->nee], 0, '', '') . " %";
                    //     if ($perr < 0) {$perr='0 %' ;}
                    //     if ($perr > 100) {$perr='100 %' ;}
                    //  if($perr == '0 %'){
                    //      $c = 'class="bg-danger disabled color-palette"';
                    //  }elseif($perr == '100 %'){$c = 'class="bg-success disabled color-palette"';}
                    //  else{ $c = 'class="bg-warning disabled color-palette"';}


                    return $this->GetSomaMunNecOiiCat($request->category, $municao->first()->id, $ommm[0]->id, $o,$request->efetivo);
                })
                ->rawColumns(['mun_nec', 'estoque'])
                ->make(true);
        }
    }

    public function ResumoMunOiiOm(Request $request)
    {
        $omg = Om::all()->sortBy('siglaOM');                     // envia todas as OM para view
        $categories = irtaexCategory::all();  // envia todas as categorias para view
        $oi = IrtaexOii::where('id',">", 0)->select('oii')->distinct()->get();

        if ($request->ajax()) {
            $matt = new MaterialOmTotalController;
            $matt->destroyaall();
            $oiis = IrtaexOii::where('irtaexcategory_id', $request->category)->get();

            if (!isset($request->oii)) {
                $o = $oiis->map(function ($value) {
                    return $value->oii;
                })->all();
            } else {
                $o = $request->oii;
            }

            $oo = $oiis->first()->where('irtaexcategory_id', $request->category)->whereIn('oii', $o)->get(); // retorna um objeto da Classe Irtaexoii
            $municao = $oo->map(function ($value) {
                return $value->vs;
            })->collapse();
            $ommm = Om::where('id', $request->om)->get();


            $coll = collect([]);

            return DataTables::of($municao)
                ->editColumn('id', function ($municao) {
                    return $municao->pivot->irtaexoii_id;
                })
                ->addColumn('tipo', function ($municao) use ($oo) {
                    return $oo[0]->where('id', $municao->pivot->irtaexoii_id)->get()->first()->oii;
                })
                ->addColumn('nome', function ($municao) {
                    return $municao->material->nome;
                })
                ->addColumn('modelo', function ($municao) {
                    return $municao->modelo;
                })
                ->addColumn('quantidade', function ($municao) use ($ommm, $oo) {
                    return $municao->pivot->quantidade;
                })
                ->addColumn('efetivo', function ($municao) use ($ommm, $oo, $request) {
                    if(!isset($request->efetivo)){
                    $o = $oo[0]->where('id', $municao->pivot->irtaexoii_id)->first()->irtaexefetivos->map(function ($item) {
                        return $item->oms;
                    })->collapse()->filter(function ($val) use ($ommm) {
                        return $val->id == $ommm[0]->id;
                    })->sum('pivot.efetivo');}
                    else{
                        $o = $request->efetivo;
                    }



                    return $o;
                })
                ->addColumn('mun_nec', function ($municao) use ($ommm, $oo, $request) {

                    if(!isset($request->efetivo)){
                        $o = $oo[0]->where('id', $municao->pivot->irtaexoii_id)->first()->irtaexefetivos->map(function ($item) {
                            return $item->oms;
                        })->collapse()->filter(function ($val) use ($ommm) {
                            return $val->id == $ommm[0]->id;
                        })->sum('pivot.efetivo');}
                        else{
                            $o = $request->efetivo;
                        }

                    $nec = $municao->pivot->quantidade;

                    return $o * $nec;
                })
                ->addColumn('estoque', function ($municao) use ($ommm, $oo) {
                    return '<div><b>'.$municao->material->oms->filter(function ($iten) use ($ommm) {
                        return $iten->id == $ommm[0]->id.'</b></div>';
                    })->sum('pivot.qtde');
                })
                ->addColumn('saldo', function ($municao) use ($ommm, $oo, $coll, $request) {
                    $mat = new MaterialOmTotalController;

                    if(!isset($request->efetivo)){
                        $o = $oo[0]->where('id', $municao->pivot->irtaexoii_id)->first()->irtaexefetivos->map(function ($item) {
                            return $item->oms;
                        })->collapse()->filter(function ($val) use ($ommm) {
                            return $val->id == $ommm[0]->id;
                        })->sum('pivot.efetivo');}
                        else{
                            $o = $request->efetivo;
                        }

                    $nec = $municao->pivot->quantidade;

                    $estoque = $municao->material->oms->filter(function ($iten) use ($ommm) {
                        return $iten->id == $ommm[0]->id;
                    })->sum('pivot.qtde');

                    $coll[$municao->material->nee] = $o * $nec;
                    $mat->retiradaStore($coll[$municao->material->nee], $estoque, $municao->material);

                    $per = $mat->index($municao->material) + $coll[$municao->material->nee];
                    if($coll[$municao->material->nee] > 0){
                        $perr = number_format($per * 100 / $coll[$municao->material->nee], 0, '', '') . " %";
                    }else{$perr = -1;}
                    if ($perr < 0) {
                        $perr = '0 %';
                    }
                    if ($perr > 100) {
                        $perr = '100 %';
                    }
                    if ($perr == '0 %') {
                        $c = 'class="bg-danger disabled color-palette"';
                    } elseif ($perr == '100 %') {
                        $c = 'class="bg-success disabled color-palette"';
                    } else {
                        $c = 'class="bg-warning disabled color-palette"';
                    }

                    $saldo_atu = $mat->index($municao->material);
                    $disponibilidade = (- $mat->index($municao->material) - $coll[$municao->material->nee] )* -1;

                    if($disponibilidade < 0){$disponibilidade = 0;}

                    return '<div ' . $c . '>' . $disponibilidade . '  <span class="badge badge-info right ml-2 mb-1">' . $perr . '</span></div>';
                })

                ->rawColumns(['efetivo', 'saldo','estoque'])

                ->make(true);
        }

        return view('irtaex.om.mun.index', compact('omg', 'categories','oi'));
    }

    public function indexChart(Request $request)
    {
        return $this->ResumoMunTotOmChart($request);
    }

    public function ResumoMunTotOmChart(Request $request)
    {

        $omg = Om::all()->sortBy('siglaOM');                     // envia todas as OM para view
        $categories = irtaexCategory::all();  // envia todas as categorias para view
        $oi = IrtaexOii::where('id',">", 0)->select('oii')->distinct()->get();

        $gcmdos = Comando::all()->sortBy('siglaCmdo');
        foreach ($gcmdos as $gcmdo) {
            $g[] = $gcmdo->id;
        }

        // $matcalibre = IrtaexOii::where('irtaexcategory_id', 1)->whereIn('oii', ['TIA','TCB'])->get();
         
        // $mm = $matcalibre->map(function ($value) {
        //     return $value->vs;
        // })->collapse()->groupBy('nee');
        // dd($mm);
        

         if ($request->ajax()) {

            

            // $oiis = IrtaexOii::where('irtaexcategory_id', $request->category)->get();
            $matcalibre = IrtaexOii::where('irtaexcategory_id', $request->category)->whereIn('oii', $request->oii)->get();

            // if (!isset($request->oii)) {
            //     $o = $matcalibre->map(function ($value) {
            //         return $value->oii;
            //     })->all();
            // } else {
            //     $o = $request->oii;
            // }

            // $matcalibre = $matcalibre->whereIn('oii', $o)->get();

            $nomeOM = collect([]);
            $dados = collect([[0,67,0,35,77],[0,67,65,35,77],[0,67,65,35,0],[0,67,65,35,77],[0,67,65,35,77]]);
            $om = collect([]);
            $category = collect([]);
            $m[] = '';


           // $matcalibre = V::whereIn('id', [3])->with('material')->get();
                  $municao = $matcalibre->map(function ($value) {
                        return $value->vs;
                    })->collapse()->groupBy('nee');

            if (isset($request->om)) {
                $om = $request->om;

                    $nomeOm = Om::where('id', $om)->get()->first();
                   

                    unset($m);

                    foreach ($municao as $mun) {
                        
                        $nomeOM->push($mun[0]->tipo." ".$mun[0]->modelo." ".$mun[0]->calibre); 
                        $m[] = 35;
                   
                    }
                    
                   // $nomeOM->push("teste"); 
                    
                    
                   // for ($ii = 0; $ii < $matcalibre->count(); $ii++) {
                        // $q =  $matcalibre[$ii]->material->oms->filter(function ($iten) use ($nomeOm) {
                        //     return $iten->id == $nomeOm->id;
                        // })->sum('pivot.qtde');
                       // $m[] = 35;
                  //  }
                //    $dados->push($m);
            } 

            $teste = collect([]);
            $teste->put('TIP',['Cartucho 9mm'=>12,'Cartucho 7,62 comum'=>25,'Cartucho 7,62 festim'=>50]);
            $teste->put('TIB',['Cartucho 9mm'=>27,'Cartucho 7,62 comum'=>41,'Cartucho 7,62 festim'=>44]);
            $teste->put('TIA',['Cartucho 9mm'=>3,'Cartucho 7,62 comum'=>15,'Cartucho 7,62 festim'=>20]);

            $r[] = [$matcalibre, $nomeOM, $dados];


            return $teste;
         
        }
        return view('irtaex.om.mun.indexChart', compact('omg', 'categories','oi','gcmdos'));
    }

    /**
     * Soma o efetivo por OII sendo que cada OII entra como uma collection por categoria
     * retorna um inteiro
     */

    public function SomaEfetivoOii(Collection $col)
    {
        $r = 0;
        foreach ($col as $coll) {
            foreach ($coll->irtaexefetivos as $item1) {
                $i = $item1->oms[0]->pivot->efetivo;
                $r = $r + $i;
            }
        }

        return $r;  // retorna o somatório como int
    }

    public function SomaEfetivoOiiOm(IrtaexOii $oo, $om)
    {

        $omm = Om::find($om);
        $efe = $oo->irtaexefetivos->map(function ($item) {
            return $item->oms;
        })->collapse()->filter(function ($val) use ($omm) {
            return $val->id == $omm[0]->id;
        })->sum('pivot.efetivo');
        return $efe;
    }

    /**
     * $cat $municao e $om são numeros que servem para fazer os finds nos modelos
     */

    public function GetSomaMunNecOiiCat($cat, $municao, $om, $o, $efetivo)
    {

        $municao = V::find($municao);
        $om = Om::find($om);

        $oiis = IrtaexOii::where('irtaexcategory_id', $cat)->whereIn('oii', $o)->get();

        $mun = $oiis->map(function ($value) {
            return $value->vs;
        })->collapse()->filter(function ($item) use ($municao) {
            return $item->id == $municao->id;
        });

        $col = collect([]);
        foreach ($mun as $m) {
            $col->push($m->pivot->irtaexoii_id);
        } // a colecao guarda os irtaexoii_id

        $res = collect([]);

        $v = $oiis->map(function ($value) use ($municao) {
            return $value->vs->where('nee', $municao->nee);
        })->collapse();
        $i = 0;
        foreach ($v as $qtde) {

            
            if(!isset($efetivo)){
                
                $efe = $oiis->where('id', $col[$i])->first()->irtaexefetivos->map(function ($item) {
                    return $item->oms;
                })->collapse()->filter(function ($val) use ($om) {
                    return $val->id == $om->id;
                })->sum('pivot.efetivo');
                $res->push($efe * $qtde->pivot->quantidade);
            }else{
                $efe = $efetivo;
                $res->push($efe * $qtde->pivot->quantidade);
            }

            $i++;
        }
        return $res->sum();
    }
}
