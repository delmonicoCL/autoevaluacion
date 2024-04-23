<?php

use App\Http\Controllers\UsuarisController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});


Route::get('/1', function () {
    return view('usuarios.form');
});

Route::resource('usuaris', UsuarisController::class);