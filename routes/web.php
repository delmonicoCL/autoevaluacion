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

Route::get('/login', [UsuarisController::class, 'showLogin'])->name('login');
Route::post('/login', [UsuarisController::class, 'login']);
Route::get('/logout', [UsuarisController::class, 'logout']);

Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        $user = Auth::user();

        return view('home', compact('user'));
    });

});