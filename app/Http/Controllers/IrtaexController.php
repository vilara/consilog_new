<?php

namespace App\Http\Controllers;

use App\IrtaexEfetivo;
use App\IrtaexOii;
use App\Om;
use App\V;
use Illuminate\Http\Request;

class IrtaexController extends Controller
{
    public function ResumoMunOiiOm(Om $om){

        $oii = IrtaexOii::all();
        $efe = IrtaexEfetivo::with('oms')->get();
        $om = Om::where('codom',4321)->get();
        $v = V::with('irtaexoiis')->get();
        return view('irtaex.om.mun.index', compact('om', 'oii', 'v', 'efe'));
    }
}
