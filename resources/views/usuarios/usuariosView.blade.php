@extends('layouts.main')

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
      <form  form action="{{ route('usuaris.index') }}" method="GET">
         <div class="row d-flex align-items-center justify-content-start"> 
            <div class="col-4">
                  <div class="mb-3">
                     <label for="tipo_usuario" class="form-label">Filtrar por Tipo de Usuario:</label>
                     <select class="form-select" id="tipo_usuario" name="tipo_usuario">
                        <option value="">Todos</option>
                        <option value="1" {{ request()->tipo_usuario == '1' ? 'selected' : '' }}>Administrador</option>
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
                        <td>
                            <form class="float-right ml-1"
                                action="{{ action([App\Http\Controllers\UsuarisController::class, 'destroy'], ['usuari' => $usuarioFiltrado->id]) }}"
                                method="POST" onsubmit="return confirmarBorrado()">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm rojo text-white"><i class="fa fa-trash"
                                        aria-hidden="true"></i> Borrar</button>
                            </form>
                            <script>
                                function confirmarBorrado() {
                                    return confirm("¿Estás seguro de que deseas borrar este usuario?");
                                }
                            </script>
                        </td>
                        <td>

                        
                            <form
                                action="{{ action([App\Http\Controllers\UsuarisController::class, 'edit'], ['usuari' => $usuarioFiltrado->id]) }}"
                                method="POST" class="float-right">
                                @method('GET')
                                <button type="submit" class="btn btn-sm naranja text-white">
                                    <i class="fa fa-edit" aria-hidden="true"></i> Editar
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

        <!-- Modal Editar Usuario -->
        {{-- <div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editarModalLabel">Editar Usuario</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="modalBody">
                        <!-- Aquí se cargarán los datos del usuario -->

                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nom_usuari"
                                placeholder="Ingrese su nombre">
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nom"
                                placeholder="Ingrese su nombre">
                        </div>
                        <div class="form-group">
                            <label for="apellido">Apellido</label>
                            <input type="text" class="form-control" id="apellido" name="cognom"
                                placeholder="Ingrese su apellido">
                        </div>
                        <div class="form-group">
                            <label for="contraseña">Contraseña</label>
                            <input type="password" class="form-control" id="contraseña" name="contrasenya"
                                placeholder="Ingrese su contraseña">
                        </div>
                        <div class="form-group">
                            <label for="correo">Correo</label>
                            <input type="email" class="form-control" id="correo" name="correu"
                                placeholder="Ingrese su correo">
                        </div>
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <select class="form-select" id="estado" name="actiu"
                                aria-label="Default select example">
                                <option selected>Seleccione Estado</option>
                                <option value="1">Activo</option>
                                <option value="2">No Activo</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tipo_usuario">Tipo de Usuario</label>
                            <select class="form-select" id="tipo_usuario" name="tipus_usuaris_id"
                                aria-label="Default select example">
                                <option selected>Seleccione Categoria</option>
                                <option value="1">Administrador</option>
                                <option value="2">Profesor</option>
                                <option value="3">Alumno</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn rojo text-white" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn lila text-white">Guardar</button>
                    </div>
                </div>
            </div>
        </div> --}}


        <!-- Modal Nuevo Usuario -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo Usuario</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="{{ action([App\Http\Controllers\UsuarisController::class, 'store']) }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="nombre">Nombre de usuario</label>
        <input type="text" class="form-control" id="nombre" name="nom_usuari" placeholder="Ingrese su nombre" required>
    </div>
    <div class="form-group">
        <label for="nombre">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nom" placeholder="Ingrese su nombre" required>
    </div>
    <div class="form-group">
        <label for="apellido">Apellido</label>
        <input type="text" class="form-control" id="apellido" name="cognom" placeholder="Ingrese su apellido" required>
    </div>
    <div class="form-group">
        <label for="contraseña">Contraseña</label>
        <input type="password" class="form-control" id="contraseña" name="contrasenya" placeholder="Ingrese su contraseña" required>
    </div>
    <div class="form-group">
        <label for="correo">Correo</label>
        <input type="email" class="form-control" id="correo" name="correu" placeholder="Ingrese su correo" required>
    </div>
    <div class="form-group">
        <label for="estado">Estado</label>
        <select class="form-select" id="estado" name="actiu" aria-label="Default select example" required>
            <option value="" selected disabled>Seleccione Estado</option>
            <option value="1">Activo</option>
            <option value="2">No Activo</option>
        </select>
    </div>
    <div class="form-group">
        <label for="tipo_usuario">Tipo de Usuario</label>
        <select class="form-select" id="tipo_usuario" name="tipus_usuaris_id" aria-label="Default select example" required>
            <option value="" selected disabled>Seleccione Categoria</option>
            <option value="1">Administrador</option>
            <option value="2">Profesor</option>
            <option value="3">Alumno</option>
        </select>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn rojo text-white" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn lila text-white">Guardar</button>
    </div>
</form>

                    </div>
                </div>
            </div>
        </div>


        <!-- Script  Usuario -->
        {{-- <script>
            function editarUsuario(userId) {
                $.ajax({
                    url: '/usuaris/' + userId + '/edit',
                    type: 'GET',
                    success: function(response) {
                        // Actualizar el contenido del modal con los datos recibidos
                        $('#modalBody').html(response);
                        // Mostrar el modal
                        $('#editarModal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        // Manejar errores si es necesario
                    }
                });
            }
        </script> --}}
    </div>
@endsection
