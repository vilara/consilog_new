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

class IrtaexController extends Controller
{
    public function ResumoMunOiiOm(Request $request)
    {
        $omg = Om::all();                     // envia todas as OM para view
        $categories = irtaexCategory::all();  // envia todas as categorias para view
        $ois = IrtaexOii::where('irtaexcategory_id', 1)->select('oii', 'id')->get();
        // $ui = $ois;
        // $yy = $ois->where('id',3)->first()->irtaexefetivos->map(function($item){
        //    return $item->oms;
        // })->collapse();
        // $yt = $yy->filter(function($val){
        //     return $val->id == 15;
        // })->sum('pivot.efetivo');
        // dd($yt);

        if ($request->ajax()) {
            $oiis = IrtaexOii::where('irtaexcategory_id', $request->category)->select('oii', 'id')->get();
            $municao = $oiis->map(function ($value) {
                return $value->vs;
            })->collapse();
            $ommm = Om::where('id', $request->om)->get();

            //dd($municao);

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

                    $o = $oiis[0]->where('id',$municao->pivot->irtaexoii_id)->first()->irtaexefetivos->map(function($item){
                        return $item->oms;
                     })->collapse()->filter(function($val) use ($ommm){
                        return $val->id == $ommm[0]->id;
                    })->sum('pivot.efetivo');
                    

                    return $o;
                })
                ->addColumn('mun_nec', function ($municao) use ($ommm, $oiis) {

                    $o = $oiis[0]->where('id',$municao->pivot->irtaexoii_id)->first()->irtaexefetivos->map(function($item){
                        return $item->oms;
                     })->collapse()->filter(function($val) use ($ommm){
                        return $val->id == $ommm[0]->id;
                    })->sum('pivot.efetivo');

                    $nec = $municao->pivot->quantidade;

                    return $o * $nec;
                })

                ->make(true);
        }

        $u = new IrtaexController;


        $oii = IrtaexOii::all();
        $efe = IrtaexEfetivo::with('oms')->get();
        $om = Om::where('codom', 4321)->first();
        $v = V::with('irtaexoiis')->get();
        return view('irtaex.om.mun.index', compact('om', 'oii', 'v', 'efe', 'u', 'omg', 'categories'));
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
}
