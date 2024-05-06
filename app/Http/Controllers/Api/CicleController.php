<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\cicle;
use Illuminate\Http\Request;
use App\Http\Resources\CicleResource;
use Illuminate\Database\QueryException;
use App\Clases\Utilidad;


class CicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $cicle = Cicle::all();
        return CicleResource::collection($cicle);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cicle = new cicle();
        $cicle->sigles = $request->input('sigles');
        $cicle->descripcio = $request->input('descripcio');
        $cicle->actiu = $request->input('actiu');

        try {
            $cicle->save();
            return response()->json(['mensaje' => 'Registro insertado correctamente'], 201);
        } catch (QueryException $ex) {
            $mensaje = Utilidad::errorMessage($ex);
            return response()->json(['error' => $mensaje], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(cicle $cicle)
    {


        $cicle = Cicle::with('moduls')->find($cicle->id);
        return new CicleResource($cicle);    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, cicle $cicle)
    {
        //
    }

    public function destroy(cicle $cicle)
{
    try {
        $cicle->delete();
        $response = response()->json(['mensaje' => "Registro borrado correctamente"], 200);
           
    } catch (QueryException $ex) {
        $mensaje = Utilidad::errorMessage($ex);
        $response = response()->json(['error'=> $mensaje], 400);
    }
    return $response; // Aquí estás devolviendo la instancia de respuesta
}
}
   