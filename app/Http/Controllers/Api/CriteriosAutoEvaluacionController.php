<?php

namespace App\Http\Controllers\Api;

use App\Clases\Utilidad;
use Illuminate\Http\Request;
use App\Models\criteris_avaluacio;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Http\Resources\CriteriosAutoevaluacionResource;

class CriteriosAutoEvaluacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
           $criterios = criteris_avaluacio::all();
           return CriteriosAutoevaluacionResource::collection($criterios);

    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $criteris_avaluacio = new criteris_avaluacio();
        $criteris_avaluacio->ordre = $request->input('ordre');
        $criteris_avaluacio->descripcio = $request->input('descripcio');
        $criteris_avaluacio->actiu = ($request->input('actiu') == 'actiu');
        $criteris_avaluacio->resultats_aprenentatge_id = $request->input('resultats_aprenentatge_id');
        try {

            $criteris_avaluacio->save();
            $response = (new CriteriosAutoevaluacionResource($criteris_avaluacio))
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
    public function show(criteris_avaluacio $criteris_avaluacio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, criteris_avaluacio $criteris_avaluacio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(criteris_avaluacio $criteris_avaluacio)
    {
        //
    }
}
