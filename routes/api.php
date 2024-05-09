<?php

use App\Http\Controllers\Api\CicleController;
use App\Http\Controllers\Api\CriteriosAutoEvaluacionController;
use App\Http\Controllers\Api\MatriculadosControllerAPI;
use App\Http\Controllers\Api\ResultadosAprendizajeController;
use App\Http\Controllers\Api\UsuariosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserHasModulsController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Route::apiResource('usuaris_has_moduls', MatriculadosControllerAPI::class);
Route::apiResource('cicle', CicleController::class);
Route::apiResource('resultats_aprenentatge', ResultadosAprendizajeController::class);
Route::apiResource('criteris_avaluacio', CriteriosAutoEvaluacionController::class);
Route::apiResource('usuaris', UsuariosController::class);

Route::post('matricula/{usuaris_id}/{moduls_id}', [MatriculadosControllerAPI::class, 'matricular']);
Route::delete('matricula/{usuaris_id}/{moduls_id}', [MatriculadosControllerAPI::class, 'desmatricular']);


Route::get('usuariosmodulos', [MatriculadosControllerAPI::class, 'getModulosUsuarios']);
Route::get('50', [MatriculadosControllerAPI::class, 'getModulosUsuario50']);

Route::get('usuarios_modulos', [MatriculadosControllerAPI::class, 'getModulosUsuario']);
