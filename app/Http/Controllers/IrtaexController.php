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
use App\Http\Controllers\OmMaterialController;


class IrtaexController extends Controller
{

    public function ResumoMunTotOm(Request $request)
    {


        if ($request->ajax()) {
            $oiis = IrtaexOii::where('irtaexcategory_id', $request->category)->select('oii', 'id')->get();
            $municao = $oiis->map(function ($value) {
                return $value->vs;
            })->collapse()->groupBy('id');
            $ommm = Om::where('id', $request->om)->get();
            return DataTables::of($municao)
                ->editColumn('id', function ($municao) {
                    return $municao[0]->modelo;
                })
                ->editColumn('estoque', function ($municao) use ($ommm) {
                    return $municao[0]->material->oms->filter(function ($iten) use ($ommm) {
                        return $iten->id == $ommm[0]->id;
                    })->sum('pivot.qtde');
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
                    $matomcontrole = new OmMaterialController;

                    $o = $oiis[0]->where('id', $municao->pivot->irtaexoii_id)->first()->irtaexefetivos->map(function ($item) {
                        return $item->oms;
                    })->collapse()->filter(function ($val) use ($ommm) {
                        return $val->id == $ommm[0]->id;
                    })->sum('pivot.efetivo');

                    $nec = $municao->pivot->quantidade;

                    $coll[$municao->material->nee] = $o * $nec;
                    $mat->retiradaStore($coll[$municao->material->nee], $matomcontrole->SomaMunicaoTotalNee($municao->material->nee), $municao->material);
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
}
