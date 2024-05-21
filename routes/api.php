<?php

use App\Http\Controllers\Api\CicleController;
use App\Http\Controllers\Api\CriteriosAutoEvaluacionController;
use App\Http\Controllers\Api\MatriculadosControllerAPI;
use App\Http\Controllers\Api\ResultadosAprendizajeController;
use App\Http\Controllers\Api\UsuariosController;
use App\Http\Controllers\Api\usuariosModulosControlador;
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


Route::get('usuarioID/{usuaris_id}', [MatriculadosControllerAPI::class, 'usuarioIDmodulo']);
Route::get('usuarioAutenticadoIDmodulo', [MatriculadosControllerAPI::class, 'usuarioAutenticadoIDmodulo']);

Route::get('rubricas', [ResultadosAprendizajeController::class, 'desplegar']);
Route::get('rubricas/{moduls_id}', [ResultadosAprendizajeController::class, 'desplegarModul']);


Route::get('rubric/{moduls_id}/{usuaris_id}', [ResultadosAprendizajeController::class, 'desplegarModulTODOS']);


Route::get('rubri/{moduls_id}/{usuaris_id}', [ResultadosAprendizajeController::class, 'desplegarModulUNO']);








// Route::get('modulosusuarios', [usuariosModulosControlador::class, 'index']);

// Route::get('usuarios_modulos', [MatriculadosControllerAPI::class, 'getModulosUsuario']); //revisar
// Route::get('85', [MatriculadosControllerAPI::class, 'getModulosUsuario85']);