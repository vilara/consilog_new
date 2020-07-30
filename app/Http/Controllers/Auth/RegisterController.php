<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make ( $data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ],
        [  // mensagens de erro
            'name.required' => 'O Campo nome é obrigatório.',
            'name.string' => ' O Campo nome pode conter somente letras.',
            'email.required' => 'O Campo e-mail é obrigatório.',
            'email.email' => 'Campo e-mail inválido.',
            'email.unique' => 'Email já cadastrado.',
            'password.required' => 'O Campo senha é obrigatório.',
            'password.min' => 'O Campo senha deve ser preenchido com no mínimo 06 caracteres.',
            'password.confirmed' => 'Favor confirmar a senha corretamente.',

         ] );

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $usu = new User();

        $usu->name = $data['name'];
        $usu->email = $data['email'];
        $usu->password = Hash::make($data['password']);

        $usu->save();
        // $usu->rolers()->attach(1);
        return $usu;

    }

}
