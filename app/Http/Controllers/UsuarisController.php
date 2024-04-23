<?php

namespace App\Http\Controllers;

use App\Models\usuaris;
use Illuminate\Http\Request;

class UsuarisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {



        $tipo_usuario = $request->tipo_usuario;

        if ($tipo_usuario) {
            $usuarios = Usuaris::where('tipus_usuaris_id', $tipo_usuario)->paginate(10);
        } else {
            $usuarios = Usuaris::paginate(10);
        }

        return view('usuarios.usuariosView', ['usuarios' => $usuarios]);

               
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
        $usuarios = new Usuaris();

        $usuarios->nom_usuari = $request->input('nom_usuari');
        $usuarios->contrasenya = $request->input('contrasenya');
        $usuarios->correu = $request->input('correu');
        $usuarios->nom = $request->input('nom');
        $usuarios->cognom = $request->input('cognom');
        $usuarios->actiu = $request->input('actiu');
        $usuarios->tipus_usuaris_id = $request->input('tipus_usuaris_id');

        $usuarios->save();

        return redirect()->action([UsuarisController::class, 'index']);
    }

    /**
     * Display the specified resource.
     */
    public function show(usuaris $usuaris)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(usuaris $usuari)
    {

        $usuarios = Usuaris::find($usuari->id);
       
        return view('usuarios.updateUsuario', compact('usuarios'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, usuaris $usuari)
    {
        // Actualizar los campos del usuario con los valores de la solicitud
        $usuari->nom_usuari = $request->input('nom_usuari');
        $usuari->contrasenya = $request->input('contrasenya');
        $usuari->correu = $request->input('correu');
        $usuari->nom = $request->input('nom');
        $usuari->cognom = $request->input('cognom');
        $usuari->actiu = $request->input('actiu');
        $usuari->tipus_usuaris_id = $request->input('tipus_usuaris_id');

        // Guardar los cambios en la base de datos
        $usuari->save();

        // Redirigir al usuario a la página de índice
        return redirect()->action([UsuarisController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuaris $usuari)
    {
        $usuari->delete();

        return redirect()->action([UsuarisController::class, 'index']);
    }
}
