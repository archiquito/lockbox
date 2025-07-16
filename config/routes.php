<?php

use Core\Route;
use App\Controllers\IndexController;
use App\Controllers\LoginController;
use App\Controllers\RegisterController;
use App\Controllers\DashboardController;
use App\Controllers\LogoutController;

(new Route())

    ->get('/', IndexController::class)

    ->get('/login', [LoginController::class, 'index'])
    ->post('/login', [LoginController::class, 'login'])
    ->get('/logout', LogoutController::class)
    ->get('/dashboard', DashboardController::class)
    ->get('/register', [RegisterController::class, 'index'])
    ->post('/register', [RegisterController::class, 'register'])


    ->run();
