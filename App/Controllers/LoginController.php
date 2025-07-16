<?php

namespace App\Controllers;

use Core\Database;
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

            $passwordForm = $_POST['password'];
            $passwordCrypt = password_verify($_POST['password'], PASSWORD_DEFAULT);

            $DBCONN = new Database(config('database'));

            $sql = "SELECT * FROM users WHERE email=:email";
            $user = $DBCONN->query(
                query: $sql,
                class: User::class,
                params: [
                    'email' => $_POST['email'],
                ]
            )->fetch();

            if ($user && password_verify($_POST['password'], $user->password)) {
                flash()->make('auth', ['id' => $user->id, 'name' => $user->name]);

                return redirect('/dashboard');
            } else {
                flash()->make('loginValidation', ['Usuário ou senha estão incorretos!']);
                return view('login');
            }
        }
        return view('login');
    }
}
