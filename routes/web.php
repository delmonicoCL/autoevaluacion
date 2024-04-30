<?php

use App\Http\Controllers\CicleController;
use App\Http\Controllers\UsuarisController;
use App\Http\Controllers\ModulsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});


Route::get('/1', function () {
    return view('usuarios.form');
});

Route::resource('usuaris', UsuarisController::class);
Route::resource('cicles', CicleController::class);
Route::resource('moduls', ModulsController::class);


Route::get('/login', [UsuarisController::class, 'showLogin'])->name('login');
Route::post('/login', [UsuarisController::class, 'login']);
Route::get('/logout', [UsuarisController::class, 'logout']);

Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        $user = Auth::user();

        return view('home', compact('user'));
    });

});