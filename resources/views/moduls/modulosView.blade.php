@extends('layouts.main1')

@section('contenido')
    <div class="container mt-5">
        
      <div class="">
            <h2>MODULOS</h2>
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
                <i class="fa fa-plus-circle" aria-hidden="true"></i> Nuevo Modulo
            </a>
        </div>

        <!-- Tabla de Modulos -->
        <table class="mt-2 table table-hover table-borderless">
            <thead class="table-dark lila">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Codigo</th>
                    <th scope="col">Siglas</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Ciclo</th>
                    <th scope="col">Estado</th>
                    <th scope="col" style="text-align: center;">Borrar</th>
                    <th scope="col" >Editar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($modulos as $moduloFiltrado)
                    <tr>
                        <td>{{ $moduloFiltrado->id }}</td>
                        <td>{{ $moduloFiltrado->codi }}</td>
                        <td>{{ $moduloFiltrado->sigles }}</td>
                        <td>{{ $moduloFiltrado->nom }}</td>
                        {{-- <td>{{ $moduloFiltrado->cicles_id }}</td> --}}
                         <td>{{ $moduloFiltrado->cicle->sigles }}</td> <!-- Accediendo al campo 'sigles' a través de la relación 'cicle' -->
                        
                        <td>
                            @if ($moduloFiltrado->actiu == 1)
                                <span>Activo</span>
                            @elseif ($moduloFiltrado->actiu == 2)
                                <span>Inactivo</span>
                            @else
                                <span>Otro</span>
                            @endif
                        </td>
                        <td style="text-align: center;">
                            <form class="float-right ml-1"
                                action="{{ action([App\Http\Controllers\ModulsController::class, 'destroy'], ['modul' => $moduloFiltrado->id]) }}"
                                method="POST" onsubmit="return confirmarBorrado()">
                                @csrf
                                @method('DELETE')
                                 <button type="submit" class="btn btn-eliminar">
                                <i class="fa fa-trash" aria-hidden="true"></i> Borrar
                            </button>
                            </form>
                            <script>
                                function confirmarBorrado() {
                                    return confirm("¿Estás seguro de que deseas borrar este MODULO?");
                                }
                            </script>
                        </td>
                        <td style="text-align: center;">
                            <div class="col-8">
                                <a href="#" class="btn btn-editar naranja text-white" data-bs-toggle="modal"
                                    data-bs-target="#ModalEditarModulo"
                                    data-bs-whatever="{{ $moduloFiltrado->codi}}|{{ $moduloFiltrado->sigles }}|{{ $moduloFiltrado->nom }}|{{ 
                                    $moduloFiltrado->actiu }}|{{ 
                                    $moduloFiltrado->cicles_id }}|{{ $moduloFiltrado->cicle->sigles}}">
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
                    {{ $modulos->links() }}
                </div>
            </div>
        </div>

        <!-- Modal Nuevo Modulo -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo Modulo</h1>
                        <button type="button" title="Cerrar Ventana" class="btn-cerrar" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ action([App\Http\Controllers\ModulsController::class, 'store']) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="nombre">Codigo</label>
                                <input type="text" class="form-control" id="codi" name="codi" placeholder="Ingrese Codigo" required>
                            </div>
                            <div class="form-group">
                                <label for="nombre">Siglas</label>
                                <input type="text" class="form-control" id="sigles" name="sigles" placeholder="Ingrese Sigla" required>
                            </div>
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nom" name="nom" placeholder="Ingrese descripcion" required>
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
                                <label for="ID_Ciclos">ID_Ciclos</label>
                                <input type="text" class="form-control" id="cicles_id" name="cicles_id" placeholder="Ingrese ID_Ciclos" required>
                            </div>
                            <div class="modal-footer mt-4">
                                <button type="submit" title="Guardar cambios" class="btn-guardar">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

         <!-- Modal Editar Modulo -->
        <div class="modal fade" id="ModalEditarModulo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                        <h4 class="modal-title" id="modalBorradoLabel">Editar Modulo</h4>
                        <button type="button" title="Cerrar Ventana" class="btn-cerrar" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                         <form action="{{ action([App\Http\Controllers\ModulsController::class, 'update'], ['modul' => $moduloFiltrado->id]) }}"
                             id="formulariocEditar" method="POST">
                            @csrf
                             @method('PUT')
                            <div class="form-group">
                                <label for="nombre">Codigo</label>
                                <input type="text" class="form-control" id="codiEDIT" name="codi" placeholder="Ingrese Codigo" required>
                            </div>
                            <div class="form-group">
                                <label for="nombre">Siglas</label>
                                <input type="text" class="form-control" id="siglesEDIT" name="sigles" placeholder="Ingrese Sigla" required>
                            </div>
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nomEDIT" name="nom" placeholder="Ingrese descripcion" required>
                            </div>
                           <div class="form-group">
                                <label for="estado">Estado</label>
                                <select class="form-select" id="estadoEditarEDIT" name="actiu" required>
                                    <option value="1">Activo</option>
                                    <option value="2">No Activo</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="ID_Ciclos">ID_Ciclos</label>
                                <input type="text" class="form-control" id="cicles_idEDIT" name="cicles_id"  readonly>
                            </div>
                            <div class="form-group">
                                <label for="nombre">Nombre del Ciclo</label>
                                <input type="text" class="form-control" id="cicles_siglesEDIT" name="cicles_sigles">
                            </div>

                            <div class="modal-footer mt-4">
                                <button type="submit" title="Guardar cambios" class="btn-guardar">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

      <script>
    const modalEditarModulo = document.getElementById('ModalEditarModulo');
    if (modalEditarModulo) {
        modalEditarModulo.addEventListener('shown.bs.modal', event => {
            const button = event.relatedTarget;
            const data = button.getAttribute('data-bs-whatever').split('|');
            const codi = data[0];
            const sigles = data[1];
            const nom = data[2];
            const cicles_id = data[3];
            const actiu = data[4];
            const cicles_sigles = data[5]; // Nombre del ciclo
            // console.log(cicles_sigles);
            // Actualiza los campos del formulario con los datos del módulo
            modalEditarModulo.querySelector('#codiEDIT').value = codi;
            modalEditarModulo.querySelector('#siglesEDIT').value = sigles;
            modalEditarModulo.querySelector('#nomEDIT').value = nom;
            modalEditarModulo.querySelector('#cicles_idEDIT').value = cicles_id;
            modalEditarModulo.querySelector('#cicles_siglesEDIT').value = cicles_sigles; // Establece el nombre del ciclo
            modalEditarModulo.querySelector('#estadoEditarEDIT').value = actiu;
        });
    }
</script>


<script>
    // Encuentra todos los botones de edición
    const botonesEditar = document.querySelectorAll('.btn-editar');

    // Itera sobre cada botón y agrega un evento de clic
    botonesEditar.forEach(botonEditar => {
        botonEditar.addEventListener('click', () => {
            // Obtén el valor de data-bs-whatever del botón actual
            const dataWhatever = botonEditar.getAttribute('data-bs-whatever');

            // Imprime el valor en la consola
            console.log('Valor de data-bs-whatever:', dataWhatever);
        });
    });
</script>



    </div>
@endsection
