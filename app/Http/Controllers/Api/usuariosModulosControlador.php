<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\usuaris_has_moduls;
use Illuminate\Http\Request;
use App\Http\Resources\UsuariosModulosResource;
use Illuminate\Database\QueryException;
use App\Clases\Utilidad;


class usuariosModulosControlador extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
          
     $modulosUsuarios = usuaris_has_moduls::all();
        return UsuariosModulosResource::collection($modulosUsuarios);
    }
   
}
