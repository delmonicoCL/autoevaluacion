@extends('layouts.main1')

@section('contenido')
    <div class="container mt-5">

        <div class="">
            <h2>USUARIOS</h2>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif


        <!-- Formulario de filtrado por tipo de usuario -->
        <form form action="{{ route('usuaris.index') }}" method="GET">
            <div class="row d-flex align-items-center justify-content-start">
                <div class="col-4">
                    <div class="mb-3">
                        <label for="tipo_usuario" class="form-label">Filtrar por Tipo de Usuario:</label>
                        <select class="form-select" id="tipo_usuario" name="tipo_usuario">
                            <option value="">Todos</option>
                            <option value="1" {{ request()->tipo_usuario == '1' ? 'selected' : '' }}>Administrador
                            </option>
                            <option value="2" {{ request()->tipo_usuario == '2' ? 'selected' : '' }}>Profesor</option>
                            <option value="3" {{ request()->tipo_usuario == '3' ? 'selected' : '' }}>Alumno</option>
                        </select>
                    </div>
                </div>
                <div class="col-8">
                    <button type="submit" class="btn lila text-white">Filtrar</button>
                    <a href="" class="btn celeste text-white" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i> Nuevo Usuario
                    </a>
                </div>                
            </div>
        </form>


        <!-- Tabla de usuarios -->
        <table class="mt-2 table table-hover table-borderless">
            <thead class="table-dark lila">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Tipo de Usuario</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Borrar</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Password</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuarioFiltrado)
                    <tr>
                        <td>{{ $usuarioFiltrado->id }}</td>
                        <td>{{ $usuarioFiltrado->nom_usuari }}</td>
                        <td>{{ $usuarioFiltrado->correu }}</td>
                        <td>{{ $usuarioFiltrado->nom }}</td>
                        <td>{{ $usuarioFiltrado->cognom }}</td>
                        <td>
                            @if ($usuarioFiltrado->tipus_usuaris_id == 1)
                                <span>Administrador</span>
                            @elseif ($usuarioFiltrado->tipus_usuaris_id == 2)
                                <span>Profesor</span>
                            @elseif ($usuarioFiltrado->tipus_usuaris_id == 3)
                                <span>Alumno</span>
                            @else
                                <span>Otro</span>
                            @endif
                        </td>
                        <td>
                            @if ($usuarioFiltrado->actiu == 1)
                                <span>Activo</span>
                            @elseif ($usuarioFiltrado->actiu == 2)
                                <span>Inactivo</span>
                            @else
                                <span>Otro</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <form class="float-right ml-1"
                                action="{{ action([App\Http\Controllers\UsuarisController::class, 'destroy'], ['usuari' => $usuarioFiltrado->id]) }}"
                                method="POST" onsubmit="return confirmarBorrado()">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-eliminar" data-bs-toggle="modal"
                                    data-bs-target="#modalBorrado"><i class="fa fa-trash" aria-hidden="true"></i>
                                    Borrar</button>
                            </form>
                            <script>
                                function confirmarBorrado() {
                                    $('#modalBorrado').modal('show');
                                    return false; // Evita que el formulario se envíe automáticamente
                                }
                            </script>
                        </td>
                        <td style="text-align: center;">
                
                                <a href="#" class="btn btn-enviado naranja text-white" data-bs-toggle="modal"
                                    data-bs-target="#ModalEditarUsuario"
                                    data-bs-whatever="{{ $usuarioFiltrado->nom_usuari}}|{{ $usuarioFiltrado->nom }}|{{ $usuarioFiltrado->cognom }}|{{ $usuarioFiltrado->contrasenya }}|{{ 
                                    $usuarioFiltrado->tipus_usuaris_id }}|{{ 
                                    $usuarioFiltrado->actiu }}|{{ $usuarioFiltrado->correu }}">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i> ModalUser
                                </a>
                         
                        </td>
                        <td class="text-center">
                            <form>
                                {{-- action="{{ action([App\Http\Controllers\UsuarisController::class, 'edit'], ['usuari' => $usuarioFiltrado->id]) }}"
                                method="POST" class="float-right">
                                @method('GET') --}}
                                <button type="" class="btn-password">
                                    <i class="fa fa-edit" aria-hidden="true"></i> Password
                                </button>
                            </form>
                        </td>    
                        

                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class=" container row  d-flex justify-content-between align-items-center">

            <div class="col-2 ">
                <div>
                    {{ $usuarios->links() }}
                </div>
            </div>
        </div>

        <!-- Modal Nuevo Usuario -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo Usuario</h1>
                        <button type="button" title="Cerrar Ventana" class="btn-cerrar" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ action([App\Http\Controllers\UsuarisController::class, 'store']) }}"
                            method="POST">
                            @csrf
                            <div class="form-group mt-2">
                                <label for="nombre">Usuario</label>
                                <input type="text" class="form-control" id="nom_usuari" name="nom_usuari" required>
                            </div>
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nom" name="nom" required>
                            </div>
                            <div class="form-group">
                                <label for="apellido">Apellido</label>
                                <input type="text" class="form-control" id="apellido" name="cognom" required>
                            </div>
                            <div class="form-group">
                                <label for="contraseña">Contraseña</label>
                                <input type="password" class="form-control" id="contraseña" name="contrasenya" required>
                            </div>
                            <div class="form-group">
                                <label for="correo">Correo</label>
                                <input type="email" class="form-control" id="correo" name="correu" required>
                            </div>
                            <div class="form-group">
                                <label for="estado">Estado</label>
                                <select class="form-select form-group" id="estado" name="actiu"
                                    aria-label="Default select example" required>
                                    <option class="form-group" value="" selected disabled>Seleccione Estado</option>
                                    <option value="1">Activo</option>
                                    <option value="2">No Activo</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tipo_usuario">Tipo de Usuario</label>
                                <select class="form-select" id="tipus_usuaris_id" name="tipus_usuaris_id"
                                    aria-label="Default select example" required>
                                    <option value="" selected disabled>Seleccione Categoria</option>
                                    <option value="1">Administrador</option>
                                    <option value="2">Profesor</option>
                                    <option value="3">Alumno</option>
                                </select>
                            </div>
                            <div class="modal-footer mt-4">
                                <button type="submit" title="Guardar cambios" class="btn-guardar">Guardar</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Editar Usuario -->
        <div class="modal fade" id="ModalEditarUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                        <h4 class="modal-title" id="modalBorradoLabel">Editar Usuario</h4>
                        <button type="button" title="Cerrar Ventana" class="btn-cerrar" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                       
                        <form action=""  method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="nombre">Usuario</label>
                                <input type="text" class="form-control" id="nom_usuariUPDATE" name="nom_usuari"
                                    value=""required>
                            </div>
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombreUPDATE" name="nom" value=""required>
                            </div>
                            <div class="form-group">
                                <label for="apellido">Apellido</label>
                                <input type="text" class="form-control" id="apellidoUPDATE" name="cognom"
                                    value=""required>
                            </div>
                            <div class="form-group">
                                <label for="contraseña">Contraseña</label>
                                <input type="password" class="form-control" id="contraseñaUPDATE" name="contrasenya"
                                    value=""required>
                            </div>
                            <div class="form-group">
                                <label for="correo">Correo</label>
                                <input type="email" class="form-control" id="correoUPDATE" name="correu"
                                    value=""required>
                            </div>
                            <div class="form-group">
                                <label for="estado">Estado</label>
                                <select class="form-select" id="estadoUPDATE" name="actiu" aria-label="Default select example" required>
                                    <option value="1" >Activo</option>
                                    <option value="2" >No Activo</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tipo_usuario">Tipo de Usuario</label>
                                <select class="form-select" id="tipo_usuarioUPDATE" name="tipus_usuaris_id" aria-label="Default select example" required>
                                    <option value="1" >Administrador</option>
                                    <option value="2" >Profesor</option>
                                    <option value="3">Alumno</option>
                                </select>
                            </div>  
                        </form>

                         <div class="modal-footer mt-4">
                                <button type="submit" title="Guardar cambios" class="btn-guardar">Guardar</button>
                         </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- Modal de confirmación de borrado -->
        <div class="modal fade" id="modalBorrado" tabindex="-1" aria-labelledby="modalBorradoLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between">
                        <h4 class="modal-title" id="modalBorradoLabel">Confirmar Borrado</h4>
                        <button type="button" title="Cerrar Ventana" class="btn-cerrar" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h5>¿Estás seguro de que deseas borrar este usuario?</h5>
                    </div>
                    <div class="modal-footer">

                        <button type="submit" title="Borrar usuario" class="btn-guardar"
                            id="btnConfirmarBorrado">Borrar</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
        const modalEditarUsuario = document.getElementById('ModalEditarUsuario');
        if (modalEditarUsuario) {
            modalEditarUsuario.addEventListener('show.bs.modal', event => {
                const button = event.relatedTarget;
                const data = button.getAttribute('data-bs-whatever').split('|');
                const nom_usuari = data[0];
                const nom = data[1];
                const cognom = data[2];
                const contrasenya = data[3];
                const tipus_usuaris_id = data[4];
                const actiu = data[5];
                const correu = data[6];

                // Actualiza los campos del formulario con los datos del usuario
                modalEditarUsuario.querySelector('#nom_usuariUPDATE').value = nom_usuari;
                modalEditarUsuario.querySelector('#nombreUPDATE').value = nom;
                modalEditarUsuario.querySelector('#apellidoUPDATE').value = cognom;
                modalEditarUsuario.querySelector('#contraseñaUPDATE').value = contrasenya;
                modalEditarUsuario.querySelector('#tipo_usuarioUPDATE').value = tipus_usuaris_id;
                modalEditarUsuario.querySelector('#estadoUPDATE').value = actiu;
                modalEditarUsuario.querySelector('#correoUPDATE').value = correu;
        });
    }
</script>


    </div>
@endsection
