<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\usuaris_has_moduls;
use App\Models\Usuaris;
use App\Models\Moduls;
use Illuminate\Http\Request;

class MatriculadosControllerAPI extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos recibidos del request
        $request->validate([
            'usuaris_id' => 'required',
            'moduls_id' => 'required',
        ]);

        // Crear una nueva relación Usuaris_Has_Moduls
        usuaris_has_moduls::create($request->all());

        return response()->json(['message' => 'Relación creada correctamente'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(usuaris_has_moduls $usuaris_has_moduls)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, usuaris_has_moduls $usuaris_has_moduls)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($usuaris_id, $moduls_id)
    {
        // Encontrar la relación Usuaris_Has_Moduls
        $relation = usuaris_has_moduls::where('usuaris_id', $usuaris_id)
            ->where('moduls_id', $moduls_id)
            ->first();

        if (!$relation) {
            return response()->json(['message' => 'La relación no existe'], 404);
        }

        // Borrar la relación
        $relation->delete();

        return response()->json(['message' => 'Relación borrada correctamente'], 200);
    }
}
