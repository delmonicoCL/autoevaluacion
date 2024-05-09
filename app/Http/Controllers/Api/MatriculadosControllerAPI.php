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


    public function getModulosUsuarioId()
    
    {
        dd('La función getModulosUsuarioId() se está llamando correctamente');
        // Obtén el ID del usuario autenticado
        $userId = Auth::id();

        // Obtén los módulos del usuario autenticado
        $userModules = Usuaris::with('moduls')->find($userId);
        // Muestra por consola lo que devuelve $userModules
        var_dump($userModules); // o dd($userModules) si prefieres un dump and die
        
        return response()->json($userModules);
    }



    


    public function getModulosUsuarios()
    {
        $usersWithModuls = Usuaris::with('moduls')->get();
        return response()->json($usersWithModuls);
    }

    

    public function getModulosUsuario85()
    {
        // Obtén solo los módulos del usuario con usuaris_id 85
        $userModules = Usuaris::with([
            'moduls' => function ($query) {
                $query->where('usuaris_has_moduls.usuaris_id', 85); // Filtra por usuaris_id 85
            }
        ])->find(85); // Encuentra el usuario con usuaris_id 85

        return response()->json($userModules);
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