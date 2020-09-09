<?php

namespace App\Http\Controllers;

use App\IrtaexEfetivo;
use App\IrtaexOii;
use App\Om;
use App\V;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class IrtaexController extends Controller
{
    public function ResumoMunOiiOm(Om $om)
    {

        $u = new IrtaexController;

        $oii = IrtaexOii::all();
        $efe = IrtaexEfetivo::with('oms')->get();
        $om = Om::where('codom', 4321)->first();
        $v = V::with('irtaexoiis')->get();
        return view('irtaex.om.mun.index', compact('om', 'oii', 'v', 'efe', 'u'));
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
                $i = $item1->oms->where('id',$om->id)->first()->pivot->efetivo;
                $r = $r + $i;
            }
        }

        return $r;  // retorna o somatório como int
    }
}
