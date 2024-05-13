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


    // public function getModulosUsuario()
    // {
    //     // Obtén el ID del usuario autenticado
    //     $userId = Auth::id();
    
    //     // Obtén solo los módulos del usuario autenticado
    //     $userModules = Usuaris::with([
    //         'moduls' => function ($query) use ($userId) {
    //             $query->where('usuaris_has_moduls.usuaris_id', $userId); // Filtra por usuaris_id dinámicamente
    //         }
    //     ])->find($userId); // Encuentra el usuario con el ID dinámico
    
    //     return response()->json($userModules);
    // }
    


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
                $query->where('usuaris_has_moduls.usuaris_id', 85); // Filtra por usuaris_id 50
            }
        ])->find(85); // Encuentra el usuario con usuaris_id 50

        return response()->json($userModules);
    }
   


    // public function usuarioIDmodulo(Request $request, $usuaris_id)
    // {
    //     // Obtén solo los módulos del usuario con el ID pasado por la ruta
    //     $userModules = Usuaris::with([
    //         'moduls' => function ($query) use ($usuaris_id) {
    //             $query->where('usuaris_has_moduls.usuaris_id', $usuaris_id); // Filtra por el ID pasado por la ruta
    //         }
    //     ])->find($usuaris_id); // Encuentra el usuario con el ID pasado por la ruta

    //     return response()->json($userModules);
    // }


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
    // public function usuarioAutenticadoIDmodulo(Request $request)
    // {
    //     // Obtenemos el usuario autenticado
    //     $user = Auth::user();

    //     // Imprimir el valor de $user por consola
    //     var_dump($user);    
                
    //         $userModules = Usuaris::with([
    //             'moduls' => function ($query) use ($user) {
    //                 $query->where('usuaris_has_moduls.usuaris_id', $user->id); // Filtra por el ID del usuario autenticado
    //             }
    //         ])->find($user->id); // Encuentra el usuario autenticado

    //         return response()->json($userModules);
       
    // }




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