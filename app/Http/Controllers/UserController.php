<?php

namespace App\Http\Controllers;

use App\Cargo;
use App\Comando;
use App\Detail;
use App\Om;
use App\Postograd;
use App\Roler;
use App\User;
use Illuminate\Database\Eloquent\Collection;
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
//             
        $user = User::with('detail')->get();

      //  dd($user->om);

        return view('users.index', compact('user'));
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
        $user->delete();
        return redirect ( '/usuarios/' )->with ( 'success', 'Usuário excluído com sucesso!' );
    }

    /**
     * Mostra o grande comando diretamente enquadrante do usuário
     */
    public function gCmdoDiretamenteEnqdUser(User $user)
    {
       return $user->detail->om->comandosOmds()->first() ;
    }

    /**
     * Mosra os comandos enquadrantes do usuário
     */
    public function gCmdosEnqdUser(User $user)
    {
       return $user->detail->om->comandos() ;
    }

    /**
     * Mostra se o usuário pertence a um grande comando
    */
    public function isUserGCmdo(User $user)
    {
       $comandos = Comando::all();
       return $comandos->contains('codomOm', $user->detail->om->codom);
    }
}
