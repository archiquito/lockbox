<?php

use Core\Route;
use App\Controllers\IndexController;
use App\Controllers\LoginController;
use App\Controllers\RegisterController;
use App\Controllers\LogoutController;
use App\Controllers\NotesController;
use App\Middlewares\GuestMiddleware;
use App\Middlewares\AuthMiddleware;
use App\Controllers\SearchController;

(new Route())

    ->get('/', IndexController::class, GuestMiddleware::class)

    ->get('/login', [LoginController::class, 'index'], GuestMiddleware::class)
    ->post('/login', [LoginController::class, 'login'], GuestMiddleware::class)

    ->get('/register', [RegisterController::class, 'index'], GuestMiddleware::class)
    ->post('/register', [RegisterController::class, 'register'], GuestMiddleware::class)

    //logged in routes
    ->get('/notes', [NotesController::class, 'index'], AuthMiddleware::class)
    ->get('/notes-make', [NotesController::class, 'make'], AuthMiddleware::class)
    ->post('/notes', [NotesController::class, 'make'], AuthMiddleware::class)
    // ->get('/notes?search={search}', SearchController::class, AuthMiddleware::class)
    // ->get('/notes/{id}', [NotesController::class, 'show'], AuthMiddleware::class)
     ->post('/notes-update', [NotesController::class, 'update'], AuthMiddleware::class)

    ->get('/logout', LogoutController::class, AuthMiddleware::class)


    ->run();
