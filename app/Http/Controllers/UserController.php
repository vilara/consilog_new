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
            
        $user = User::has('detail')->get()->filter(function($user) {
            if(Auth::user()->can('view', $user)){
                return $user;
            }
          });;

        if ($request->ajax()) {

            return Datatables::of($user)
                ->setRowClass(function (User $user) {
                    return $user->id % 2 == 0 ? '' : '';
                })
                ->addColumn('action', function (User $user) {
                    $c = "'Confirma exclusão de usuário?'";
                    $r = "profile/delete/".$user->id;
                    $d = "@csrf @method('DELETE')";
                    if (Auth::user()->can('update')) {
                        return '
                        <div class="row"  style="height: 25px;">
                            <div class="col-md-6 mx-auto" style="height: 25px;">
                                <a href="/usuarios/' . $user->id . '/edit" style="color: inherit;" ><center><i class="fas fa-edit"	title="Alterar usu&aacute;rio"></i></center></a>            
                            </div>
                            <div class="col-md-6">
                                <form class="form-group" action="'.$r.'" method="post">
                                <button class="btn form-control pt-0 " type="submit" onclick="return confirm('.$c.')"><i class="far fa-trash-alt"></i></button>            
                                </form>
                            </div>
                        </div>
                        ';
                    } else {
                        return '<a disabled="disabled" href="/usuario/' . $user->id . '" class="' . $d . '" style="color: inherit;" ><i class="fas fa-edit"	title="Alterar usu&aacute;rio"></i></a>';
                    }
                //    <a href="/usuarios/' . $user->id . '/edit" class="' . $d . '" ><i class="fas fa-edit"	title="Alterar usu&aacute;rio"></i></a>
                //    <a href="/usuarios/' . $user->id . '/edit" class="' . $d . ' float-right" onclick="return confirm('.$c.')"><i class="fas fa-trash-alt"	title="Excluir usu&aacute;rio"></i></a>
                })
                ->editColumn('name', function (User $user) {
                    return '<a href="/usuarios/' . $user->id . '" style="color: inherit;" >' . $user->name . '</a>';
                })
                ->editColumn('om', function (User $user) {
                    return $user->detail->om->siglaOM;
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
