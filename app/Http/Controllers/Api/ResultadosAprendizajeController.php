<?php

namespace App\Http\Controllers\Api;

use App\Clases\Utilidad;
use App\Models\alumnes_has_criteris_avaluacio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\resultats_aprenentatge;
use Illuminate\Database\QueryException;
use App\Http\Resources\ResultadosAprendizajeResource;
use Illuminate\Support\Facades\DB;



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

    public function desplegar()
    {
         $resultats_aprenentatge = resultats_aprenentatge::with('criteris_avaluacio', 'criteris_avaluacio.rubriques')
         ->where('moduls_id', 7)
         ->get();
         return response()->json($resultats_aprenentatge);  
    }

    public function desplegarModulUNO($moduls_id, $idUsuario)
    {
        // Filtra los registros por el moduls_id y el id_usuario pasado a la función
        $resultats_aprenentatge = resultats_aprenentatge::with([
            'criteris_avaluacio',
            'criteris_avaluacio.rubriques',
            'criteris_avaluacio.alumnesHasCriterisAvaluacio' => function ($query) use ($idUsuario) {
                $query->where('usuaris_id', $idUsuario);
            }
        ])->where('moduls_id', $moduls_id)->get();
    
        return response()->json($resultats_aprenentatge);
    }
    



  public function desplegarModul($moduls_id)
    {
       // Filtra los registros por el moduls_id pasado a la función
         $resultats_aprenentatge = resultats_aprenentatge::with([
             'criteris_avaluacio',
             'criteris_avaluacio.rubriques'
         ])->where('moduls_id', $moduls_id)->get();

         return response()->json($resultats_aprenentatge);
     }



public function desplegarModulTODOS($moduls_id, $usuaris_id)
{
    $resultats_aprenentatge = resultats_aprenentatge::with([
        'criteris_avaluacio' => function ($query) use ($usuaris_id) {
            $query->with(['rubriques', 'alumnesHasCriterisAvaluacio' => function ($subquery) use ($usuaris_id) {
                $subquery->select('usuaris_id', 'criteris_avaluacio_id', 'nota')
                         ->where('usuaris_id', $usuaris_id);
            }])->whereHas('alumnesHasCriterisAvaluacio', function ($subquery) use ($usuaris_id) {
                $subquery->where('usuaris_id', $usuaris_id);
            });
        }
    ])->where('moduls_id', $moduls_id)->get();

    // var_dump($resultats_aprenentatge);
    return response()->json($resultats_aprenentatge);
    
}


    public function actualizarNota(Request $request)
    {
        // Valida los datos recibidos en la solicitud
        $request->validate([
            'usuaris_id' => 'required|integer',
            'criteris_avaluacio_id' => 'required|integer',
            'nota' => 'required|numeric'
        ]);

        try {
            // Actualiza la nota en la tabla correspondiente
            alumnes_has_criteris_avaluacio::updateOrCreate(
                [
                    'usuaris_id' => $request->usuaris_id,
                    'criteris_avaluacio_id' => $request->criteris_avaluacio_id
                ],
                ['nota' => $request->nota]
            );

            // Devuelve una respuesta exitosa
            return response()->json(['message' => 'Nota actualizada con éxito'], 200);
        } catch (\Exception $e) {
            // Devuelve un mensaje de error en caso de fallo
            return response()->json(['error' => 'Error al actualizar la notas DESDE CONTROLADOR'], 500);
        }
    }



    // public function actualizarNota(Request $request,$usuaris_id,$criteris_avaluacio_id,$nota)
    // {
    //     // Valida los datos de la solicitud
    //     $request->validate([
    //         'usuaris_id' => 'required',
    //         'criteris_avaluacio_id' => 'required',
    //         'nota' => 'required|numeric',
    //     ]);

    //     // Obtiene los datos de la solicitud
    //     $usuaris_id = $request->input('usuaris_id');
    //     $criteris_avaluacio_id = $request->input('criteris_avaluacio_id');
    //     $nota = $request->input('nota');

    //     // Realiza la lógica para actualizar la nota en la base de datos
    //     // Aquí deberías escribir el código para actualizar la nota en la tabla correspondiente

    //     // Retorna una respuesta de éxito
    //     return response()->json(['message' => 'Nota actualizada con éxito'], 200);
    // }


    public function nota(Request $request, $usuaris_id, $criteris_avaluacio_id, $nota)
    {

        $nota->nota = $request->input('nota');

        try {
            $nota->save();
            return response()->json(['mensaje' => 'Registro insertado correctamente'], 201);
        } catch (QueryException $ex) {
            $mensaje = Utilidad::errorMessage($ex);
            return response()->json(['error' => $mensaje], 400);
        }
    }



}


