<?php

namespace App\Http\Controllers\Api;

use App\Clases\Utilidad;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\resultats_aprenentatge;
use Illuminate\Database\QueryException;
use App\Http\Resources\ResultadosAprendizajeResource;


class ResultadosAprendizajeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $resultados = resultats_aprenentatge::all();
        return ResultadosAprendizajeResource::collection($resultados);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $resultats_aprenentatge = new resultats_aprenentatge();
        $resultats_aprenentatge->ordre = $request->input('ordre');
        $resultats_aprenentatge->descripcio = $request->input('descripcio');
        $resultats_aprenentatge->actiu = ($request->input('actiu') == 'actiu');
        $resultats_aprenentatge->moduls_id = $request->input('moduls_id');
        try {

            $resultats_aprenentatge->save();
            $response = (new ResultadosAprendizajeResource($resultats_aprenentatge))
                ->response()
                ->setStatusCode(201);

            // return redirect()->action([CicleController::class, 'index'])->with('success', 'Usuario creado exitosamente.'); CONTROLADOR NORMAL

        } catch (QueryException $ex) {

            $mensaje = Utilidad::errorMessage($ex);
            $response = \response()
                ->json(['error' => $mensaje], 400);

            // return redirect()->action([CicleController::class, 'index'])->with('error', $mensaje)->withInput(); CONTROLADOR NORMAL
        }
        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show(resultats_aprenentatge $resultats_aprenentatge)
    {
        
        $resultats_aprenentatge = resultats_aprenentatge::with('criteris_avaluacio')->find($resultats_aprenentatge->id);
        return new ResultadosAprendizajeResource($resultats_aprenentatge);    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, resultats_aprenentatge $resultats_aprenentatge)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(resultats_aprenentatge $resultats_aprenentatge)
    {
        //
    }
}
