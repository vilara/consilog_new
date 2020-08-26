<?php

namespace App\Http\Controllers;

use App\Material;
use App\V;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class VController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $material = Material::with('materialable')->get();
       // dd($v);
        if ($request->ajax()) {
            return DataTables::of($material)
            ->editColumn('nome', function (Material $material) {
                return '<span title=“'.$material->descricao.'”  >' . $material->nome . '</span>';
            })
            ->editColumn('tipo', function (Material $material) {
                return $material->materialable->tipo;
            })
            ->editColumn('modelo', function (Material $material) {
                return $material->materialable->modelo;
            })
            ->editColumn('calibre', function (Material $material) {
                return $material->materialable->calibre;
            })
            ->rawColumns(['nome'])
            ->make(true);
        }
        return view('classes.v.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\V  $v
     * @return \Illuminate\Http\Response
     */
    public function show(V $v)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\V  $v
     * @return \Illuminate\Http\Response
     */
    public function edit(V $v)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\V  $v
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, V $v)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\V  $v
     * @return \Illuminate\Http\Response
     */
    public function destroy(V $v)
    {
        //
    }
}
