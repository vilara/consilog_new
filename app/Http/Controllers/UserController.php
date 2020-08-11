<?php

namespace App\Http\Controllers;

use App\Cargo;
use App\Detail;
use App\Om;
use App\Postograd;
use App\Roler;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $data = User::all();
        if ($request->ajax()) {

            return Datatables::of($data)
                ->setRowClass(function ($user) {
                    return $user->id % 2 == 0 ? 'text-success' : 'text-primary';
                })
                ->addColumn('action', function ($user) {
                    $user->id % 2 == 0 ? $d = 'text-success' :  $d = 'text-primary';
                    if (Auth::user()->can('update')) {
                        return '<a href="/usuario/' . $user . '" class="' . $d . '" ><i class="fas fa-edit"	title="Alterar usu&aacute;rio"></i></a>';
                    } else {
                        return '<a disabled="disabled" href="/usuario/' . $user->id . '" class="' . $d . '" ><i class="fas fa-edit"	title="Alterar usu&aacute;rio"></i></a>';
                    }
                })
                ->editColumn('name', function (User $user) {
                    return '<a href="/usuarios/' . $user->id . '"  >' . $user->name . '</a>';
                })
                ->rawColumns(['name', 'action'])
                ->editColumn('roler', function (User $user) {
                    return $user->rolers->first()->name;
                })
                ->editColumn('created_at', function (User $user) {
                    return $user->created_at->diffForHumans();
                })
                ->make(true);
        }
        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        dd($request);
    }

    /**
     * Display the specified resource.
     *
     *  @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

        $pg = Postograd::all();
        $om = Om::all();
        $funcao = Cargo::all();
        $perfi = Roler::all();
        $detail = Detail::where('user_id', $user->id)->first();
       // dd($detail);
        if (empty($user->detail)) {
        return view('users.create', compact('user', 'pg', 'om', 'funcao', 'perfi', 'detail'));
        }else{
        return view('users.show', compact('user', 'pg', 'om', 'funcao', 'perfi', 'detail'));
        }
    }

    public function profileUser()
    {
        $user = Auth::user();
       return $this->show($user);
    }

    public function editSenha()
    {
        $user = Auth::user();
        return view('users.senha', compact('user'));
    }

   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $pg = Postograd::all();
        $om = Om::all();
        $funcao = Cargo::all();
        $perfi = Roler::all();
        $detail = Detail::where('user_id', $user->id)->first();
        // dd($funcao);
        return view('users.edit', compact('user', 'pg', 'om', 'funcao', 'perfi', 'detail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
