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

        $cicle->actiu = ($request->input('actiu') == 'actiu');
       
        try {
         
            $cicle->save();
            $response = (new CicleResource($cicle))
                ->response()
                ->setStatusCode(201);
                        
            // return redirect()->action([CicleController::class, 'index'])->with('success', 'Usuario creado exitosamente.'); CONTROLADOR NORMAL

        } catch (QueryException $ex) {
        
            $mensaje = Utilidad::errorMessage($ex);
            $response = \response()
                        ->json(['error' => $mensaje],400);
            
            // return redirect()->action([CicleController::class, 'index'])->with('error', $mensaje)->withInput(); CONTROLADOR NORMAL
        }
        return $response;
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(cicle $cicle)
    {
        //
    }
}
