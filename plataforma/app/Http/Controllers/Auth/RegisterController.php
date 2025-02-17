<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
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
    protected $redirectTo = '/grafico';

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
        return Validator::make($data, [
            'fullName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'cpf' => ['required', 'string', 'size:11', 'unique:users'],
            'estado' => ['required', 'string'],
            'cep' => ['required', 'regex:/^\d{5}-\d{3}$/'],
            'rua' => ['required', 'string', 'max:255'],
            'numeroCasa' => ['required', 'integer'],
            'numeroTel' => ['required', 'string', 'min:10', 'max:15'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'fullName' => $data['full_name'],
            'email' => $data['email'],
            'cpf' => $data['cpf'],
            'estado' => $data['estado'],
            'cep' => $data['cep'],
            'rua' => $data['rua'],
            'numeroCasa' => $data['numero_casa'],
            'numeroTel' => $data['telefone'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
