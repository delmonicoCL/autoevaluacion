@extends('layouts.main1')

@section('contenido')
        <div class="container mt-5">

            <div class="">
                <h2>CICLOS</h2>
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

            <div class="col-8">

                <a href="" class="btn celeste text-white" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Nuevo Ciclo </a>
            </div>

            <!-- Formulario de filtrado por tipo de usuario -->
            {{-- <form  form action="{{ route('usuaris.index') }}" method="GET">
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
        </form> --}}

            <!-- Tabla de ciclos -->
            <table class="mt-2 table table-hover table-borderless">
                <thead class="table-dark lila">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Siglas</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Borrar</th>
                        <th scope="col">Editar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ciclos as $cicleFiltrado)
                        <tr>
                            <td>{{ $cicleFiltrado->id }}</td>
                            <td>{{ $cicleFiltrado->sigles }}</td>
                            <td>{{ $cicleFiltrado->descripcio }}</td>

                            <td>
                                @if ($cicleFiltrado->actiu == 1)
                                    <span>Activo</span>
                                @elseif ($cicleFiltrado->actiu == 2)
                                    <span>Inactivo</span>
                                @else
                                    <span>Otro</span>
                                @endif
                            </td>


                            <td class="text-center">
                                <form class="float-right ml-1"
                                    action="{{ action([App\Http\Controllers\CicleController::class, 'destroy'], ['cicle' => $cicleFiltrado->id]) }}"
                                    method="POST" onsubmit="return confirmarBorrado()">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-eliminar">
                                        <i class="fa fa-trash" aria-hidden="true"></i> Borrar
                                    </button>
                                </form>
                                <script>
                                    function confirmarBorrado() {
                                        return confirm("¿Estás seguro de que deseas borrar este elemento?");
                                    }
                                </script>
                            </td>


                            {{-- <td class="text-center">
                                <form class="float-right ml-1"
                                    action="{{ action([App\Http\Controllers\CicleController::class, 'destroy'], ['cicle' => $cicleFiltrado->id]) }}"
                                    method="POST" onsubmit="return confirmarBorrado()">
                                    @csrf
                                    @method('DELETE')
                                <button type="button" class="btn btn-eliminar" data-bs-toggle="modal" data-bs-target="#modalBorrado">
                                        <i class="fa fa-trash" aria-hidden="true"></i> Borrar
                                    </button>
                                </form>
                                <script>
                                function confirmarBorrado() {
                                        $('#modalBorrado').modal('show');
                                        return false; // Esto previene el envío del formulario
                                    }
                                </script>
                            </td> --}}

                            <td>

                                <div class="col-8">
                                    <a href="#" class="btn btn-editar naranja text-white" data-bs-toggle="modal"
                                        data-bs-target="#ModalEditarCiclo"
                                        data-bs-whatever="{{ $cicleFiltrado->sigles }}|{{ $cicleFiltrado->descripcio }}|{{ $cicleFiltrado->actiu }}">
                                        <i class="fa fa-plus-circle" aria-hidden="true"></i> Editar
                                    </a>
                                </div>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class=" container row  d-flex justify-content-between align-items-center">

                <div class="col-2 ">
                    <div>
                        {{ $ciclos->links() }}
                    </div>
                </div>
            </div>

            <!-- Modal Nuevo Cicla -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header d-flex justify-content-between">
                            <h4 class="modal-title" id="modalBorradoLabel">Nuevo Ciclo</h4>
                            <button type="button" title="Cerrar Ventana" class="btn-cerrar" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ action([App\Http\Controllers\CicleController::class, 'store']) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="nombre">SIGLAS</label>
                                    <input type="text" class="form-control" id="sigles" name="sigles"
                                        placeholder="Ingrese SIGLA ciclo" required>
                                </div>
                                <div class="form-group">
                                    <label for="nombre">Descripcion</label>
                                    <input type="text" class="form-control" id="descripcio" name="descripcio"
                                        placeholder="Ingrese descripcion" required>
                                </div>

                                <div class="form-group">
                                    <label for="estado">Estado</label>
                                    <select class="form-select" id="estado" name="actiu"
                                        aria-label="Default select example" required>
                                        <option value="" selected disabled>Seleccione Estado</option>
                                        <option value="1">Activo</option>
                                        <option value="2">No Activo</option>
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

        <!-- Modal Editar Ciclo -->
        <div class="modal fade" id="ModalEditarCiclo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between">
                        <h4 class="modal-title" id="modalBorradoLabel">Editar Ciclo</h4>
                        <button type="button" title="Cerrar Ventana" class="btn-cerrar" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form
                            action="{{ action([App\Http\Controllers\CicleController::class, 'update'], ['cicle' => $cicleFiltrado->id]) }}"
                            id="formulariocEditar" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="nombre">Siglas</label>
                                <input type="text" class="form-control" id="siglesEditar" name="sigles" required>
                            </div>
                            <div class="form-group">
                                <label for="nombre">Descripcion</label>
                                <input type="text" class="form-control" id="descripcioEditar" name="descripcio"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="estado">Estado</label>
                                <select class="form-select" id="estadoEditar" name="actiu" required>
                                    <option value="1">Activo</option>
                                    <option value="2">No Activo</option>
                                </select>
                            </div>
                            <div class="modal-footer mt-4">
                                <button type="submit" title="Guardar cambios" class="btn-guardar">Guardar</button>
                            </div>
                        </form>
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
        </div>

        <script>
            const modalEditarCiclo = document.getElementById('ModalEditarCiclo');
            if (modalEditarCiclo) {
                modalEditarCiclo.addEventListener('show.bs.modal', event => {
                    const button = event.relatedTarget;
                    if (button) {
                        const data = button.getAttribute('data-bs-whatever');
                        if (data) {
                            const parts = data.split('|');
                            const sigles = parts[0];
                            const descripcio = parts[1];
                            const actiu = parts[2];

                            // Actualiza los campos del formulario con los datos del ciclo
                            modalEditarCiclo.querySelector('#siglesEditar').value = sigles;
                            modalEditarCiclo.querySelector('#descripcioEditar').value = descripcio;
                            modalEditarCiclo.querySelector('#estadoEditar').value = actiu;
                        }
                    }
                });
            }
        </script>
    @endsection
