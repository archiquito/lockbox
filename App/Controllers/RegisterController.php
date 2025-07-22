<?php

namespace App\Controllers;

use App\Models\User;
use Core\Validation;

class RegisterController
{
    public function index()
    {
        return view('register');
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $validate = Validation::validate([
                'name' => ['required'],
                'email' => ['required', 'email', 'confirmed', 'unique:users'],
                'password' => ['required', 'min:6', 'max:30'],
            ], $_POST);

            if ($validate->validateFail()) {
                flash()->make('registerValidation', $validate->arrValidations);

                return view('register');
            }

            User::create([
                'name' => $name,
                'email' => $email,
                'password' => $password,
            ]);
            flash()->make('msg', 'Usuário registrado com sucesso!');
        }

        return view('register');
    }
}
