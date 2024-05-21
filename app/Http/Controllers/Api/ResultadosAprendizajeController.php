<?php

namespace App\Http\Controllers\Api;

use App\Clases\Utilidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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

    public function desplegar()
    {
         $resultats_aprenentatge = resultats_aprenentatge::with('criteris_avaluacio', 'criteris_avaluacio.rubriques')
         ->where('moduls_id', 7)
         ->get();
         return response()->json($resultats_aprenentatge);  
    }


// public function desplegarModul($moduls_id)
// {
//     $resultats_aprenentatge = resultats_aprenentatge::select('id', 'descripcio')
//         ->with(['criteris_avaluacio' => function ($query) {
//             $query->select('id', 'descripcio', 'resultats_aprenentatge_id');
//         }, 'criteris_avaluacio.rubriques' => function ($query) {
//             $query->select('id', 'descripcio', 'criteris_avaluacio_id');
//         }])
//         ->where('moduls_id', $moduls_id)
//         ->get();
    
//     return response()->json($resultats_aprenentatge);
// }


    // public function desplegarModul($moduls_id)
    //  {
       
    //       $resultats_aprenentatge = resultats_aprenentatge::with('criteris_avaluacio', 'criteris_avaluacio.rubriques')
    //           ->where('moduls_id', $moduls_id)
    //           ->get();
        
    //       return response()->json($resultats_aprenentatge);
    //   }

    


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


// public function desplegarModulTODOS($moduls_id, $usuaris_id)
// {
//     $resultats_aprenentatge = resultats_aprenentatge::with([
//         'criteris_avaluacio' => function ($query) use ($usuaris_id) {
//             // Seleccionamos solo los criterios relacionados con el usuario específico
//             $query->select('id', 'descripcio', 'resultats_aprenentatge_id')
//                   ->whereHas('alumnesHasCriterisAvaluacio', function ($subquery) use ($usuaris_id) {
//                       $subquery->where('usuaris_id', $usuaris_id);
//                   });
//         },
//         'criteris_avaluacio.rubriques',
//         'criteris_avaluacio.alumnesHasCriterisAvaluacio' => function ($query) use ($usuaris_id) {
//             // Filtra los campos de la relación alumnesHasCriterisAvaluacio
//             $query->select('usuaris_id', 'criteris_avaluacio_id', 'nota')
//                   ->where('usuaris_id', $usuaris_id);
//         }
//     ])->where('moduls_id', $moduls_id)->get();

//     return response()->json($resultats_aprenentatge);
// }

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



}
