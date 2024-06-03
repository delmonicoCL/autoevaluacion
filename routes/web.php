<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CicleController;
use App\Http\Controllers\ModulsController;
use App\Http\Controllers\UsuarisController;

Route::get('/', function () {
    return view('auth.login');
});


Route::get('/1', function () {
    return view('usuarios.form');
});

Route::get('ciclos', function () {
    return view('ciclos1.index');

});


Route::get('rubricas', function () {
    return view('rubrica.index');

});

Route::get('rubricas-profesor', function () {
    return view('profesor.index');

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

route::get('ObtenerIdAlumno',[UsuarisController::class, 'ObtenerIdAlumno'] );