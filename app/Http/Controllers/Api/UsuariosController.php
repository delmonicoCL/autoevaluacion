<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UsuariosResource;
use App\Models\usuaris;
use Illuminate\Http\Request;


use App\Clases\Utilidad;
use Illuminate\Database\QueryException;


class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = usuaris::all();
        return UsuariosResource::collection($usuarios);


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $usuaris = new usuaris();
        $usuaris->nom_usuari = $request->input('nom_usuari');
        $usuaris->contrasenya = $request->input('contrasenya');
        $usuaris->correu = $request->input('correu');
        $usuaris->nom = $request->input('nom');
        $usuaris->nom = $request->input('cognom');
        $usuaris->actiu = ($request->input('actiu') == 'actiu');
        $usuaris->tipus_usuaris_id = $request->input('tipus_usuaris_id');
        try {

            $usuaris->save();
            $response = (new UsuariosResource($usuaris))
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
    public function show(usuaris $usuaris)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, usuaris $usuaris)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(usuaris $usuaris)
    {
        //
    }
}
