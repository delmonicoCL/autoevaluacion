<?php

use App\Http\Controllers\Api\CicleController;
use App\Http\Controllers\Api\CriteriosAutoEvaluacionController;
use App\Http\Controllers\Api\ResultadosAprendizajeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserHasModulsController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('usuaris_has_moduls', UserHasModulsController::class);
Route::apiResource('cicle', CicleController::class);
Route::apiResource('resultats_aprenentatge', ResultadosAprendizajeController::class);
Route::apiResource('criteris_avaluacio', CriteriosAutoEvaluacionController::class);