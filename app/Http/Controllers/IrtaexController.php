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

            if (!isset($request->om)) {
                $c = Comando::find($request->cmdo);
                $cc = $c[0]->getOmdsId();
            }else{
                $cc = $request->om;
            }

           


            $oo = $oiis->first()->where('irtaexcategory_id', $request->category)->whereIn('oii', $o)->get(); // retorna um objeto da Classe Irtaexoii
            return DataTables::of($oo)
                ->editColumn('id', function ($oo) {
                    return $oo->oii;
                })
                ->editColumn('soma', function ($oo) use ($request, $cc) {
                    if (!isset($request->efetivo)) {
                        return $this->SomaEfetivoOiiOms($oo, $cc); // $oo é um objeto da Classe Irtaexoii
                    } else {
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

            if (!isset($request->om)) {
                $c = Comando::find($request->cmdo);
                $cc = $c[0]->getOmdsId();
            }else{
                $cc = $request->om;
            }


            $oo = $oiis->first()->where('irtaexcategory_id', $request->category)->whereIn('oii', $o)->get(); // retorna um objeto da Classe Irtaexoii
            $municao = $oo->map(function ($value) {
                return $value->vs;
            })->collapse()->groupBy('nee');
            $ommm = Om::whereIn('id', $cc)->get();
            return DataTables::of($municao)
                ->editColumn('id', function ($municao) {
                    return $municao->first()->material->nome . " " . $municao->first()->modelo;
                })
                ->editColumn('estoque', function ($municao) use ($ommm, $request, $o, $cc) {

                    $estoque = $municao->first()->material->oms->whereIn('id', $cc)->sum('pivot.qtde');

                    $necc = $this->GetSomaMunNecOiiCat($request->category, $municao->first()->id, $cc, $o, $request->efetivo);
                    if ($necc > 0) {

                        $perr = number_format($estoque * 100 / $necc, 0, '', '') . " %";
                    } else {
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
                        $c = 'class="bg-warning disabled color-palette"';
                    }

                    return '<div ' . $c . '>' . $estoque  . '  <span class="badge badge-info right ml-2 mb-1">' . $perr . '</span></div>';
                })
                ->editColumn('mun_nec', function ($municao) use ($ommm, $request, $o, $cc) {
                    return $this->GetSomaMunNecOiiCat($request->category, $municao->first()->id, $cc, $o, $request->efetivo);
                })
                ->rawColumns(['mun_nec', 'estoque'])
                ->make(true);
        }
    }

    public function ResumoMunOiiOm(Request $request)
    {
        $omg = Om::all()->sortBy('siglaOM');                     // envia todas as OM para view
        $categories = irtaexCategory::all();  // envia todas as categorias para view
        $oi = IrtaexOii::where('id', ">", 0)->select('oii')->distinct()->get();
        $gcmdos = Comando::all()->sortBy('siglaCmdo');

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

            if (!isset($request->om)) {
                $c = Comando::find($request->cmdo);
                $cc = $c[0]->getOmdsId();
            }else{
                $cc = $request->om;
            }

         

            $oo = $oiis->first()->where('irtaexcategory_id', $request->category)->whereIn('oii', $o)->get(); // retorna um objeto da Classe Irtaexoii
            $municao = $oo->map(function ($value) {
                return $value->vs;
            })->collapse();
            $ommm = Om::whereIn('id', $cc)->get();


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
                ->addColumn('efetivo', function ($municao) use ($ommm, $oo, $request, $cc) {
                    if (!isset($request->efetivo)) {
                        $o = $oo[0]->where('id', $municao->pivot->irtaexoii_id)->first()->irtaexefetivos->map(function ($item) {
                            return $item->oms;
                        })->collapse()->whereIn('id', $cc)->sum('pivot.efetivo');
                    } else {
                        $o = $request->efetivo;
                    }
                    return $o;
                })
                ->addColumn('mun_nec', function ($municao) use ($ommm, $oo, $request, $cc) {

                    if (!isset($request->efetivo)) {
                        $o = $oo[0]->where('id', $municao->pivot->irtaexoii_id)->first()->irtaexefetivos->map(function ($item) {
                            return $item->oms;
                        })->collapse()->whereIn('id', $cc)->sum('pivot.efetivo');
                    } else {
                        $o = $request->efetivo;
                    }

                    $nec = $municao->pivot->quantidade;

                    return $o * $nec;
                })
                ->addColumn('estoque', function ($municao) use ($ommm, $oo, $request, $cc) {
                    return '<div><b>' . $municao->material->oms->whereIn('id', $cc)->sum('pivot.qtde').'</b></div>';
                })
                ->addColumn('saldo', function ($municao) use ($ommm, $oo, $coll, $request, $cc) {
                    $mat = new MaterialOmTotalController;

                    if (!isset($request->efetivo)) {
                        $o = $oo[0]->where('id', $municao->pivot->irtaexoii_id)->first()->irtaexefetivos->map(function ($item) {
                            return $item->oms;
                        })->collapse()->whereIn('id', $cc)->sum('pivot.efetivo');
                    } else {
                        $o = $request->efetivo;
                    }

                    $nec = $municao->pivot->quantidade;

                    $estoque = $municao->material->oms->whereIn('id', $cc)->sum('pivot.qtde');

                    $coll[$municao->material->nee] = $o * $nec;
                    $mat->retiradaStore($coll[$municao->material->nee], $estoque, $municao->material);

                    $per = $mat->index($municao->material) + $coll[$municao->material->nee];
                    if ($coll[$municao->material->nee] > 0) {
                        $perr = number_format($per * 100 / $coll[$municao->material->nee], 0, '', '') . " %";
                    } else {
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
                        $c = 'class="bg-warning disabled color-palette"';
                    }

                    $saldo_atu = $mat->index($municao->material);
                    $disponibilidade = (-$mat->index($municao->material) - $coll[$municao->material->nee]) * -1;

                    if ($disponibilidade < 0) {
                        $disponibilidade = 0;
                    }

                    return '<div ' . $c . '>' . $disponibilidade . '  <span class="badge badge-info right ml-2 mb-1">' . $perr . '</span></div>';
                })

                ->rawColumns(['efetivo', 'saldo', 'estoque'])

                ->make(true);
        }

        return view('irtaex.om.mun.index', compact('omg', 'categories', 'oi', 'gcmdos'));
    }

    public function indexChart(Request $request)
    {
        return $this->ResumoMunTotOmChart($request);
    }

    public function ResumoMunTotOmChart(Request $request)
    {

        $omg = Om::all()->sortBy('siglaOM');                     // envia todas as OM para view
        $categories = irtaexCategory::all();  // envia todas as categorias para view
        $oi = IrtaexOii::where('id', ">", 0)->select('oii')->distinct()->get();

        $gcmdos = Comando::all()->sortBy('siglaCmdo');
        foreach ($gcmdos as $gcmdo) {
            $g[] = $gcmdo->id;
        }
        if ($request->ajax()) {

            $oiis = IrtaexOii::where('irtaexcategory_id', $request->category)->whereIn('oii', $request->oii)->get();
            $municao = $oiis->map(function ($value) {
                return $value->vs;
            })->collapse()->groupBy('nee');

            if (!isset($request->om)) {
                $c = Comando::find($request->cmdo);
                $cc = $c[0]->getOmdsId();
            }else{
                $cc = $request->om;
            }



            $ommm = Om::whereIn('id', $cc)->get();
            $teste = collect([]);
            $p = collect([]);
            $mm = collect([]);
            $coll = collect([]);
            $j[] = '';
            $fill = new MaterialOmTotalController;
            foreach ($municao as $mun) {
                $mm->put($mun->first()->tipo . " " . $mun->first()->modelo . " " . $mun->first()->calibre, 1);
                unset($j);

                $estoque =   $mun->first()->material->oms->whereIn('id', $cc)->sum('pivot.qtde');

                $kil = $estoque;
                foreach ($oiis as $m) {

                    if (!isset($request->efetivo)) {
                        $o = $m->irtaexefetivos->map(function ($item) {
                            return $item->oms;
                        })->collapse()->whereIn('id', $cc)->sum('pivot.efetivo');
                    } else {
                        $o = $request->efetivo;
                    }
                    $necc = $this->GetSomaMunNecOiiCat($request->category, $mun->first()->id, $cc, $m, $request->efetivo);
                    $coll[$mun->first()->material->nee] = $necc;
                    $per =  $fill->index($mun->first()->material);
                    if ($necc == 0) {
                        $sald = 0;
                    } else {
                        if ($kil <= 3) {
                            $sald = 1;
                        }else{
                            if($kil > $necc){
                                $sald = 100;
                            }else{
                                $sald = number_format(($kil*100)/$necc, 0, '', '') ;
                            }
                        }
                    }
                    $j[] = $sald;
                    $kil = $kil - $necc;
                }
                $p->push($j);
            }
            foreach ($oiis as $mmat) {
                $teste->put($mmat->oii, $mm);
            }
            $h[] = [$teste, $p];
            return $h;
        }
        return view('irtaex.om.mun.indexChart', compact('omg', 'categories', 'oi', 'gcmdos'));
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

    public function SomaEfetivoOiiOms(IrtaexOii $oo, $oms)
    { 
        

        $omm = Om::whereIn('id',$oms)->get();
        $efe = $oo->irtaexefetivos->map(function ($item) {
            return $item->oms;
        })->collapse()->whereIn('id', $oms)->sum('pivot.efetivo');
        return $efe;
    }

    /**
     * $cat $municao e $om são numeros que servem para fazer os finds nos modelos
     */

    public function GetSomaMunNecOiiCat($cat, $municao, $om, $o, $efetivo)
    {

        $municao = V::find($municao);
       // $om = Om::find($om);

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


            if (!isset($efetivo)) {

                $efe = $oiis->where('id', $col[$i])->first()->irtaexefetivos->map(function ($item) {
                    return $item->oms;
                })->collapse()->whereIn('id', $om)->sum('pivot.efetivo');
                $res->push($efe * $qtde->pivot->quantidade);
            } else {
                $efe = $efetivo;
                $res->push($efe * $qtde->pivot->quantidade);
            }

            $i++;
        }
        return $res->sum();
    }
}
