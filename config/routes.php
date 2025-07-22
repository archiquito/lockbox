<?php

use App\Controllers\CryptNotesController;
use App\Controllers\IndexController;
use App\Controllers\LoginController;
use App\Controllers\LogoutController;
use App\Controllers\NotesController;
use App\Controllers\RegisterController;
use App\Middlewares\AuthMiddleware;
use App\Middlewares\GuestMiddleware;
use Core\Route;

(new Route)

    ->get('/', IndexController::class, GuestMiddleware::class)

    ->get('/login', [LoginController::class, 'index'], GuestMiddleware::class)
    ->post('/login', [LoginController::class, 'login'], GuestMiddleware::class)

    ->get('/register', [RegisterController::class, 'index'], GuestMiddleware::class)
    ->post('/register', [RegisterController::class, 'register'], GuestMiddleware::class)

    // logged in routes
    ->get('/notes', [NotesController::class, 'index'], AuthMiddleware::class)
    ->get('/notes/search', [NotesController::class, 'index'], AuthMiddleware::class)
    ->get('/notes/make', [NotesController::class, 'make'], AuthMiddleware::class)
    ->post('/notes/make', [NotesController::class, 'make'], AuthMiddleware::class)
    ->post('/notes/update', [NotesController::class, 'update'], AuthMiddleware::class)
    ->get('/notes/delete', [NotesController::class, 'delete'], AuthMiddleware::class)

    ->get('/notes/show', [CryptNotesController::class, 'unCrypt'], AuthMiddleware::class)
    ->get('/notes/hidden', [CryptNotesController::class, 'crypt'], AuthMiddleware::class)

    ->get('/logout', LogoutController::class, AuthMiddleware::class)

    ->run();
