<?php

namespace App\Controllers;

use Core\Validation;
use App\Models\User;

class LoginController
{
    public function index()
    {
        return view('login');
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $email = $_POST['email'];
            $password = $_POST['password'];

            $validate = Validation::validate([
                'email' => ['required', 'email'],
                'password' => ['required', 'min:6']
            ], $_POST);

            if ($validate->validateFail()) {
                flash()->make('loginValidation', $validate->arrValidations);
                return view('login');
            }

            $user = User::getUserByEmail($email);

            if ($user && password_verify( $password, $user->password)) {
                flash()->make('auth', ['id' => $user->id, 'name' => $user->name]);

                return redirect('/notes');
            } else {
                flash()->make('loginValidation', ['Usuário ou senha estão incorretos!']);
                return view('login');
            }
        }
        return view('login');
    }
}
