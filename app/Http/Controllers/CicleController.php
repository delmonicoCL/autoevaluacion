<?php

namespace App\Http\Controllers;

use App\Models\cicle;
use Illuminate\Http\Request;
use App\Clases\Utilidad;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class CicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index(Request $request)
    {
        $ciclos = Cicle::paginate(10);

        return view('ciclos.ciclosView', ['ciclos' => $ciclos]);
    }

    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $cicles = new cicle();
            $cicles->sigles = $request->input('sigles');
            $cicles->descripcio = $request->input('descripcio');
            $cicles->actiu = $request->input('actiu');
            $cicles->save();
            return redirect()->action([CicleController::class, 'index'])->with('success', 'Usuario creado exitosamente.');
        } catch (QueryException $ex) {
            // Obtener el mensaje de error utilizando la clase Utilidad
            $mensaje = Utilidad::errorMessage($ex);
            // Redirigir con un mensaje de error
            return redirect()->action([CicleController::class, 'index'])->with('error', $mensaje)->withInput();
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(cicle $cicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(cicle $cicle)
    {

        // $usuarios = cicle::find($cicle->id);

        // return view('usuarios.updateCICLO', compact('ciclos'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, cicle $cicle)
    {
        try {
           
            $cicle->sigles = $request->input('sigles');
            $cicle->descripcio = $request->input('descripcio');
            $cicle->actiu = $request->input('actiu');
            $cicle->save();
            return redirect()->action([CicleController::class, 'index'])->with('success', 'Usuario creado exitosamente.');
        } catch (QueryException $ex) {
            // Obtener el mensaje de error utilizando la clase Utilidad
            $mensaje = Utilidad::errorMessage($ex);
            // Redirigir con un mensaje de error
            return redirect()->action([CicleController::class, 'index'])->with('error', $mensaje)->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(cicle $cicle)
    {
        try {
            $cicle->delete();
            return redirect()->action([CicleController::class, 'index'])->with('success', 'Usuario eliminado exitosamente.');
        } catch (QueryException $ex) {
            // Cambiar el valor del campo 'actiu' a 2
            $cicle->actiu = 2;
            $cicle->save();

            // Obtener el mensaje de error utilizando la clase Utilidad
            $mensaje = Utilidad::errorMessage($ex);

            // Redirigir con un mensaje de error
            return redirect()->action([CicleController::class, 'index'])->with('error', 'No se puede eliminar, tiene datos relacionados, se pasa a INACTIVO');
        }
    }
}
