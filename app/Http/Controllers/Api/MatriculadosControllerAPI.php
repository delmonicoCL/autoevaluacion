<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Usuaris;
use App\Models\Moduls;
use Illuminate\Http\Request;
class MatriculadosControllerApi extends Controller
{
    public function matricular(Request $request, $usuaris_id, $moduls_id)
    {
        $usuario = Usuaris::findOrFail($usuaris_id);
        $usuario->moduls()->attach($moduls_id);

        return response()->json(['message' => 'Usuario matriculado en el módulo correctamente'], 200);
    }

    public function desmatricular(Request $request, $usuaris_id, $moduls_id)
    {
        $usuario = Usuaris::findOrFail($usuaris_id);
        $usuario->moduls()->detach($moduls_id);

        return response()->json(['message' => 'Usuario desmatriculado del módulo correctamente'], 200);
    }
}