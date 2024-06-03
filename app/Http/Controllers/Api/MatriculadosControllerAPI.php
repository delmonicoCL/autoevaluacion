<?php

namespace App\Http\Controllers\Api;

use App\Models\Moduls;
use App\Models\Usuaris;
use Illuminate\Http\Request;
use App\Models\usuaris_has_moduls;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\MatriculadosResource;

class MatriculadosControllerApi extends Controller
{

    

    public function usuarioIDmodulo(Request $request, $usuaris_id)
{
    // Obtén solo los módulos del usuario con el ID pasado por la ruta
    $userModules = Usuaris::with([
        'moduls' => function ($query) use ($usuaris_id) {
            $query->where('usuaris_has_moduls.usuaris_id', $usuaris_id); // Filtra por el ID pasado por la ruta
        }
    ])->find($usuaris_id); // Encuentra el usuario con el ID pasado por la ruta

    // Crear una nueva estructura de datos con los campos deseados
    $formattedModules = $userModules->moduls->map(function ($modulo) {
        return [
           
            'Id_Modulo' => $modulo->id,
            'codis' => $modulo->codi,
            'sigles' => $modulo->sigles,
            'nom' => $modulo->nom
        ];
    });

    // Devolver la respuesta en formato JSON
    return response()->json($formattedModules);
}

    public function getUsuariosInscritos($modulsId)
        {
            // Obtén el módulo con el ID proporcionado y carga los usuarios relacionados filtrando por tipus_usuaris_id 3
            $modulo = Moduls::with([
                'usuaris' => function ($query) {
                    $query->where('tipus_usuaris_id', 3);
                }
            ])->find($modulsId);

            // Verifica si el módulo existe
            if (!$modulo) {
                return response()->json(['message' => 'Módulo no encontrado'], 404);
            }

            // Devuelve los usuarios inscritos en el módulo con tipus_usuaris_id 3
            return response()->json($modulo->usuaris);
        }

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