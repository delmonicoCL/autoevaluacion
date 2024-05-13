<?php

namespace App\Http\Controllers;

use App\Models\usuaris;
use App\Clases\Utilidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;


class UsuarisController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     */

     public function ObtenerIdAlumno()
     {
         // Obtenemos el usuario autenticado
         $user = Auth::user();
     
         // Verificar si el usuario está autenticado
         if ($user) {
             // Si el usuario está autenticado, devolver su ID en formato JSON
             return response()->json(['id' => $user->id]);
         } else {
             // Si el usuario no está autenticado, devolver un error 401 (No autorizado)
             return response()->json(['error' => 'Usuario no autenticado'], 401);
         }
     }
     

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {

        $nom_usuari = $request->input('nom_usuari');
        $contrasenya = $request->input('contrasenya');

        $user = Usuaris::where('nom_usuari', $nom_usuari)->first();

        if ($user != null && Hash::check($contrasenya, $user->contrasenya)) {
            Auth::login($user);
            $response = redirect('/home');
        } else {
            $request ->session()->flash('Error', 'Usuario o Contraseña Erronea');
            $response = redirect('/login')->withInput();
        }
        return $response;

    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

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
        try {
            $usuarios = new Usuaris();
            $usuarios->nom_usuari = $request->input('nom_usuari');
            $contrasenya = bcrypt($request->input('contrasenya'));
            $usuarios->contrasenya = $contrasenya;
            $usuarios->correu = $request->input('correu');
            $usuarios->nom = $request->input('nom');
            $usuarios->cognom = $request->input('cognom');
            $usuarios->actiu = $request->input('actiu');
            $usuarios->tipus_usuaris_id = $request->input('tipus_usuaris_id');
            $usuarios->save();
            return redirect()->action([UsuarisController::class, 'index'])->with('success', 'Usuario creado exitosamente.');
        } catch (QueryException $ex) {
            // Obtener el mensaje de error utilizando la clase Utilidad
            $mensaje = Utilidad::errorMessage($ex);
            // Redirigir con un mensaje de error
            return redirect()->action([UsuarisController::class, 'index'])->with('error', $mensaje)->withInput();
        }
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
        try {

            $contrasenya = $request->input("Contrasenia");

            $usuari->nom_usuari = $request->input('nom_usuari');
            $usuari->contrasenya = $request->input('contrasenya');
            $usuari->contrasenya = \bcrypt($contrasenya);
            $usuari->correu = $request->input('correu');
            $usuari->nom = $request->input('nom');
            $usuari->cognom = $request->input('cognom');
            $usuari->actiu = $request->input('actiu');
            $usuari->tipus_usuaris_id = $request->input('tipus_usuaris_id');
            $usuari->save();
            return redirect()->action([UsuarisController::class, 'index'])->with('success', 'Usuario Editado exitosamente.');
        } catch (QueryException $ex) {
            // Obtener el mensaje de error utilizando la clase Utilidad
            $mensaje = Utilidad::errorMessage($ex);
            // Redirigir con un mensaje de error
            return redirect()->action([UsuarisController::class, 'index'])->with('error', $mensaje)->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuaris $usuari)
    {
        try {
            $usuari->delete();
            return redirect()->action([UsuarisController::class, 'index'])->with('success', 'Usuario eliminado exitosamente.');
        } catch (QueryException $ex) {
            // Cambiar el valor del campo 'actiu' a 2
            $usuari->actiu = 2;
            $usuari->save();

            // Obtener el mensaje de error utilizando la clase Utilidad
            $mensaje = Utilidad::errorMessage($ex);

            // Redirigir con un mensaje de error
            return redirect()->action([UsuarisController::class, 'index'])->with('error', 'No se puede eliminar, tiene datos relacionados, se pasa a INACTIVO');
        }
    }


}
