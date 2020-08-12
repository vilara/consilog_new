<?php

namespace App\Http\Controllers;

use App\Om;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Yajra\DataTables\DataTables;

class OmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $om = Om::all();
        if ($request->ajax()) {
            return DataTables::of($om)
            ->addColumn('action', function (Om $om) {
                if (Auth::user()->can('update')) {
                    $c = "'Confirma exclusão da OM?'";
                    $r = "om/delete/".$om->id;
                    $d = "@csrf @method('DELETE')";
                    return '
                    <div class="row" style="height: 25px;">
                        <div class="col-md-6 pt-0 h-auto d-inline-block">
                            <a href="/oms/' . $om->id . '/edit" class="" style="color: inherit;" ><center><i class="fas fa-edit"	title="Alterar OM"></i></center></a>            
                        </div>
                        <div class="col-md-6 pt-0 h-auto d-inline-block">
                            <form class="form-group" action="'.$r.'" method="post">
                            <button class="btn form-control pt-0 " type="submit" onclick="return confirm('.$c.')"><i class="far fa-trash-alt"></i></button>            
                            </form>
                        </div>
                    </div>
                    ';
                } else {
                    return '<a href="/oms/' . $om->id . '/edit" class="" style="color: inherit;" ><i class="fas fa-edit"	title="Alterar OM"></i></a>';
                }
            })
            ->make(true);
        }
        return view('oms.index');
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
     * @param  \App\Om  $om
     * @return \Illuminate\Http\Response
     */
    public function show(Om $om)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Om  $om
     * @return \Illuminate\Http\Response
     */
    public function edit(Om $om)
    {
        return view('oms.edit', compact('om'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Om  $om
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Om $om)
    {
        $om->nomeOm = $request->nomeOm;
        $om->siglaOM= $request->siglaOM;
        $om->codom  = $request->codom;
        $om->codug  = $request->codug;
        $om->save();
        
        return redirect ( '/oms/' )->with ( 'success', 'OM editada com sucesso!' );
       // return back()->with('message', 'Record Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Om  $om
     * @return \Illuminate\Http\Response
     */
    public function destroy(Om $om)
    {
        //
    }
}
