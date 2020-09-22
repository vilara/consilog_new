<?php

namespace App\Http\Controllers;

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

    public function ResumoMunTotOm(Request $request)
    {
       

        
        
        if ($request->ajax()) {
           
            $oiis = IrtaexOii::where('irtaexcategory_id', $request->category)->select('oii', 'id')->get();
            $municao = $oiis->map(function ($value) {
                return $value->vs;
            })->collapse()->groupBy('nee');
            $ommm = Om::where('id', $request->om)->get();
            return DataTables::of($municao)
                ->editColumn('id', function ($municao) {
                    return $municao->first()->material->nome . " " . $municao->first()->modelo;
                })
                ->editColumn('estoque', function ($municao) use ($ommm) {
                    return $municao->first()->material->oms->filter(function ($iten) use ($ommm) {
                        return $iten->id == $ommm[0]->id;
                    })->sum('pivot.qtde');
                })
                ->editColumn('mun_nec', function ($municao) use ($ommm, $request) {
                    return $this->GetSomaMunNecOiiCat($request->category, $municao->first()->id, $ommm[0]->id);
                })
                ->make(true);
        }
    }
    public function ResumoMunOiiOm(Request $request)
    {
        $omg = Om::all();                     // envia todas as OM para view
        $categories = irtaexCategory::all();  // envia todas as categorias para view

        if ($request->ajax()) {
            $matt = new MaterialOmTotalController;
            $matt->destroyaall();
            $oiis = IrtaexOii::where('irtaexcategory_id', $request->category)->select('oii', 'id')->get();
            $municao = $oiis->map(function ($value) {
                return $value->vs;
            })->collapse();
            $ommm = Om::where('id', $request->om)->get();


            $coll = collect([]);

            return DataTables::of($municao)
                ->editColumn('id', function ($municao) {
                    return $municao->pivot->irtaexoii_id;
                })
                ->addColumn('tipo', function ($municao) use ($oiis) {
                    return $oiis[0]->where('id', $municao->pivot->irtaexoii_id)->get()->first()->oii;
                })
                ->addColumn('nome', function ($municao) {
                    return $municao->material->nome;
                })
                ->addColumn('modelo', function ($municao) {
                    return $municao->modelo;
                })
                ->addColumn('quantidade', function ($municao) use ($ommm, $oiis) {
                    return $municao->pivot->quantidade;
                })
                ->addColumn('efetivo', function ($municao) use ($ommm, $oiis) {

                    $o = $oiis[0]->where('id', $municao->pivot->irtaexoii_id)->first()->irtaexefetivos->map(function ($item) {
                        return $item->oms;
                    })->collapse()->filter(function ($val) use ($ommm) {
                        return $val->id == $ommm[0]->id;
                    })->sum('pivot.efetivo');
                    return $o;
                })
                ->addColumn('mun_nec', function ($municao) use ($ommm, $oiis) {

                    $o = $oiis[0]->where('id', $municao->pivot->irtaexoii_id)->first()->irtaexefetivos->map(function ($item) {
                        return $item->oms;
                    })->collapse()->filter(function ($val) use ($ommm) {
                        return $val->id == $ommm[0]->id;
                    })->sum('pivot.efetivo');

                    $nec = $municao->pivot->quantidade;

                    return $o * $nec;
                })
                ->addColumn('estoque', function ($municao) use ($ommm, $oiis) {
                    return $municao->material->oms->filter(function ($iten) use ($ommm) {
                        return $iten->id == $ommm[0]->id;
                    })->sum('pivot.qtde');
                })
                ->addColumn('saldo', function ($municao) use ($ommm, $oiis, $coll) {
                    $mat = new MaterialOmTotalController;

                    $o = $oiis[0]->where('id', $municao->pivot->irtaexoii_id)->first()->irtaexefetivos->map(function ($item) {
                        return $item->oms;
                    })->collapse()->filter(function ($val) use ($ommm) {
                        return $val->id == $ommm[0]->id;
                    })->sum('pivot.efetivo');

                    $nec = $municao->pivot->quantidade;

                    $estoque = $municao->material->oms->filter(function ($iten) use ($ommm) {
                        return $iten->id == $ommm[0]->id;
                    })->sum('pivot.qtde');

                    $coll[$municao->material->nee] = $o * $nec;
                    $mat->retiradaStore($coll[$municao->material->nee], $estoque, $municao->material);

                 //   $per = $mat->index($ll->material) + $tot[$ll->material->nee];
                 //   $perr = number_format($per * 100 / $tot[$ll->material->nee], 0, '', '') . " %";

                    return $mat->index($municao->material);
                })
                ->rawColumns(['efetivo'])
                ->make(true);
        }

        return view('irtaex.om.mun.index', compact('omg', 'categories'));
    }

    /**
     * Soma o efetivo por OII sendo que cada OII entra como uma collection por categoria
     * retorna um inteiro
     */

    public function SomaEfetivoOii(Collection $col)
    {
        $r = 0;
        //dd($col);
        foreach ($col as $coll) {
            // dd($coll->irtaexefetivos);
            foreach ($coll->irtaexefetivos as $item1) {
                $i = $item1->oms[0]->pivot->efetivo;
                $r = $r + $i;
            }
        }

        return $r;  // retorna o somatório como int
    }

    public function SomaEfetivoOiiOm(Collection $col, Om $om)
    {
        // dd($om);
        // dd($col);
        $r = 0;
        //dd($col);
        foreach ($col as $coll) {

            //   dd($coll->irtaexefetivos);
            foreach ($coll->irtaexefetivos as $item1) {
                $i = $item1->oms->where('id', $om->id)->first()->pivot->efetivo;
                $r = $r + $i;
            }
        }

        return $r;  // retorna o somatório como int
    }

    public function GetSomaMunNecOiiCat($cat, $municao, $om)
    {     
        
        $municao = V::find($municao);
        $om = Om::find($om);

        $oiis = IrtaexOii::where('irtaexcategory_id', $cat)->get();

        $mun = $oiis->map(function ($value) {
            return $value->vs;
        })->collapse()->filter(function($item) use ($municao){
            return $item->id == $municao->id;
        });
        $col = collect([]);
        foreach ($mun as $m) {

            // $ef = $oiis[$i]->irtaexefetivos->map(function ($item) {
            //     return $item->oms;
            // })->collapse()->filter(function ($val) use ($om) {
            //     return $val->id == $om->id;
            // })->sum('pivot.efetivo');
        
            //$qtde->pivot->quantidade
        
             $col->push($m->pivot->irtaexoii_id);
        
            
            } 
               

        $res = collect([]);


        $v = $oiis->map(function($value) use ($municao){
            return $value->vs->where('nee',$municao->nee);
         })->collapse();

        //  for ($i=0; $i < $v; $i++) { 
        //     $res->push($v[$i]->id);
        //  }

        // $efe = $oiis->where('id', $mun->pivot->irtaexoii_id)->first()->irtaexefetivos->map(function ($item) {
        //     return $item->oms;
        // })->collapse()->filter(function ($val) use ($om) {
        //     return $val->id == $om->id;
        // })->sum('pivot.efetivo');
        
  $i = 0;
   foreach ($v as $qtde) {

    // $ef = $oiis[$i]->irtaexefetivos->map(function ($item) {
    //     return $item->oms;
    // })->collapse()->filter(function ($val) use ($om) {
    //     return $val->id == $om->id;
    // })->sum('pivot.efetivo');

      $efe = $oiis->where('id', $col[$i])->first()->irtaexefetivos->map(function ($item) {
            return $item->oms;
        })->collapse()->filter(function ($val) use ($om) {
            return $val->id == $om->id;
        })->sum('pivot.efetivo');

    //$qtde->pivot->quantidade

     $res->push($efe * $qtde->pivot->quantidade);

      $i++;
    } 
       
        return $res->sum();
    }


}
