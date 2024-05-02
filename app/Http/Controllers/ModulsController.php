<?php

namespace App\Http\Controllers;

use App\Models\moduls;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Clases\Utilidad;

class ModulsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modulos = Moduls::with('cicle')->get();
        $modulos = Moduls::paginate(10);

        return view('moduls.modulosView', ['modulos' => $modulos]);
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
            $modulos = new moduls();
            $modulos->codi = $request->input('codi');
            $modulos->sigles = $request->input('sigles');
            $modulos->nom = $request->input('nom');
            $modulos->actiu = $request->input('actiu');
            $modulos->cicles_id = $request->input('cicles_id');
            $modulos->save();
            return redirect()->action([ModulsController::class, 'index'])->with('success', 'Modulo creado exitosamente.');
        } catch (QueryException $ex) {
            // Obtener el mensaje de error utilizando la clase Utilidad
            $mensaje = Utilidad::errorMessage($ex);
            // Redirigir con un mensaje de error
            return redirect()->action([ModulsController::class, 'index'])->with('error', $mensaje)->withInput();
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(moduls $moduls)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(moduls $moduls)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, moduls $modul)
    {
        try {
            
            $modul->codi = $request->input('codi');
            $modul->sigles = $request->input('sigles');
            $modul->nom = $request->input('nom');
            $modul->actiu = $request->input('actiu');
            $modul->cicles_id = $request->input('cicles_id');
            $modul->save();
            return redirect()->action([ModulsController::class, 'index'])->with('success', 'Modulo editado exitosamente.');
        } catch (QueryException $ex) {
            // Obtener el mensaje de error utilizando la clase Utilidad
            $mensaje = Utilidad::errorMessage($ex);
            // Redirigir con un mensaje de error
            return redirect()->action([ModulsController::class, 'index'])->with('error', $mensaje)->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(moduls $modul)
    {
        try {
            $modul->delete();
            return redirect()->action([ ModulsController::class, 'index'])->with('success', 'Modulo eliminado exitosamente.');
        } catch (QueryException $ex) {
            // Cambiar el valor del campo 'actiu' a 2
            $modul->actiu = 2;
            $modul->save();

            // Obtener el mensaje de error utilizando la clase Utilidad
            $mensaje = Utilidad::errorMessage($ex);

            // Redirigir con un mensaje de error
            return redirect()->action([ModulsController::class, 'index'])->with('error', 'No se puede eliminar, tiene datos relacionados, se pasa a INACTIVO');
        }
    }
}
