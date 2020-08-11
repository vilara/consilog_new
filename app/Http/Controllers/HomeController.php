<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request as FacadesRequest;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }



    public function updateSenha(User $user, Request $request)
    {

        $rules = ['password' => 'required|string|min:8|confirmed'];
        $messages = [
            'password.required' => 'O Campo senha é obrigatório.',
            'password.min' => 'O Campo senha deve ser preenchido com no mínimo 06 caracteres.',
            'password.confirmed' => 'Favor confirmar a senha corretamente.',
        ];

        $this->validate($request, $rules, $messages);
        $user->password = Hash::make($request->password);
        $user->save();
        // dd($request);
        return redirect ( '/profile' )->with ( 'success', 'Senha alterada com sucesso!' );
    }
}
