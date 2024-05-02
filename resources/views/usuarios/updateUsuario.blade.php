@extends('layouts.main')

@section('contenido')
    <div class="container mt-5">

        <H2>EDITAR USUARIO</H2>

    </div>

    <div class="container mt-4">

        <div class="card-body" style="">

            <form action="{{ action([App\Http\Controllers\UsuarisController::class, 'update'], ['usuari' => $usuarios->id]) }}"
                id="formularioEditar" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nombre">Usuario</label>
                    <input type="text" class="form-control" id="nom_usuari" name="nom_usuari"
                        value="{{ $usuarios->nom_usuari }}"required>
                </div>
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nom" value="{{ $usuarios->nom }}"required>
                </div>
                <div class="form-group">
                    <label for="apellido">Apellido</label>
                    <input type="text" class="form-control" id="apellido" name="cognom"
                        value="{{ $usuarios->cognom }}"required>
                </div>
                <div class="form-group">
                    <label for="contraseña">Contraseña</label>
                    <input type="password" class="form-control" id="contraseña" name="contrasenya"
                        value="{{ $usuarios->contrasenya }}"required>
                </div>
                <div class="form-group">
                    <label for="correo">Correo</label>
                    <input type="email" class="form-control" id="correo" name="correu"
                        value="{{ $usuarios->correu }}"required>
                </div>
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <select class="form-select" id="estado" name="actiu" aria-label="Default select example" required>
                        <option value="1" {{ $usuarios->actiu == 1 ? 'selected' : '' }}>Activo</option>
                        <option value="2" {{ $usuarios->actiu == 2 ? 'selected' : '' }}>No Activo</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tipo_usuario">Tipo de Usuario</label>
                    <select class="form-select" id="tipo_usuario" name="tipus_usuaris_id" aria-label="Default select example" required>
                        <option value="1" {{ $usuarios->tipus_usuaris_id == 1 ? 'selected' : '' }}>Administrador</option>
                        <option value="2" {{ $usuarios->tipus_usuaris_id == 2 ? 'selected' : '' }}>Profesor</option>
                        <option value="3" {{ $usuarios->tipus_usuaris_id == 3 ? 'selected' : '' }}>Alumno</option>
                    </select>
                </div>  
             </form>
    </div>
</div>    
@endsection
