<?php

namespace App\Http\Controllers;

use App\Material;
use App\material_om_total;
use Illuminate\Http\Request;

class MaterialOmTotalController extends Controller
{
    
    public function index(Material $material)
    {

        $mattotal = $material->materialomtotal;
        $total = $mattotal ? $mattotal->saldo : 0;

        return $total;
    }
    
    public function destroyaall()
    {

        material_om_total::where('id','>', 0)->delete();
       
    } 

    public function retiradaStore($consumo,$estoque, Material $material)
    {

       // dd($material);
       $teste = material_om_total::firstOrCreate(['material_id' => $material->id], ['saldo' => $estoque]);
       $teste->retirada($consumo);
       
    }
}
