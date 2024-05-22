@if(Auth::check())
    @php
        header("Location:../public/home");
        exit();
    @endphp
@else

@extends('layouts.main1')

@section('contenido')

<style>
     .carousel-item img {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Hace que las imágenes ocupen todo el espacio del carrusel */
        border-radius: 25px;
    }

   
</style>

<div class="container mt-5">

    
    <div class="row justify-content-center">
        <div class="col-7 custom-margin d-flex justify-content-center align-items-center">
    <div id="carouselExampleAutoplaying" class="carousel slide w-75" data-bs-ride="carousel" data-bs-interval="5000"> <!-- Intervalo de 5 segundos -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('img/4.png') }}" class="d-block " alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/5.png') }}" class="d-block " alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/1.png') }}" class="d-block " alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/2.png') }}" class="d-block " alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/3.png') }}" class="d-block " alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>


    <div class="col-5 custom-margin">
           
            <div class=" mb-5 custom-margin d-flex flex-column ">
               <H1 class="align-items-center font" style="font-size: 60px;">AUTOEVALUACION</H1>
               <p class="mt-2" style="font-size: 18px; border-radius: 10px; padding: 10px;"> La autoevaluación es un método mediante el cual una persona evalúa su propio desempeño o manejo de una situación específica. Este proceso implica una reflexión interna en la que se identifican tanto las fortalezas como las áreas de mejora.</p>
             
            </div>

                <div class="card mt-3">
    <div class="header-login h2">
        LOGIN
    </div>
    <div class="card-body">
        <form action="{{ action([App\Http\Controllers\UsuarisController::class,'login']) }}" method="POST">
            @csrf
            @if (session()->has('Error'))
            <div class="alert alert-danger" role="alert">
                {{ session()->get('Error') }}
            </div>
            @endif

            <div class="mb-3">
                <label for="UserName" class="form-label">Nombre de usuario</label>
                <input type="text" class="form-control" id="nom_usuari" name="nom_usuari" autofocus value="">
            </div>
            <div class="mb-3">
                <label for="contrasenya" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="contrasenya" name="contrasenya" autofocus value="">
            </div>
            <div class="text-end mt-2">
                
                <button type="submit" class="btn-enviado"><i class="fa fa-check" aria-hidden="true"></i> Aceptar</button>
            </div>
        </form>
    </div>
    <div class="card-footer">
        <h5>¿No tienes cuenta?</h5> <a href="" data-bs-toggle="modal" data-bs-target="#modalCrearCuenta">Haz clic aquí</a>.
    </div>
</div>


   <!-- Modal Nuevo Usuario -->
        <div class="modal fade" id="modalCrearCuenta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Crear nuevo Usuario</h1>
                        <button type="button" title="Cerrar Ventana" class="btn-cerrar" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                     <div class="modal-body">
                <p>Para crear una cuenta en autoevaluacion comunicaque con tu profesor guia.</p>
                <!-- Agrega más contenido si es necesario -->
            </div>
                </div>
            </div>
        </div>


{{-- <!-- Modal Crear Cuenta -->
<div class="modal fade" id="modalCrearCuenta" tabindex="-1" aria-labelledby="modalCrearCuentaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCrearCuentaLabel">Crear Cuenta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Para crear una cuenta en autoevaluacion comunicaque con tu profesor guia.</p>
                <!-- Agrega más contenido si es necesario -->
            </div>
        </div>
    </div>
</div> --}}

            
        </div>
    </div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function () {
        const crearCuentaBtn = document.getElementById('crearCuentaBtn');
        const crearCuentaModal = new bootstrap.Modal(document.getElementById('crearCuentaModal'));

        crearCuentaBtn.addEventListener('click', function () {
            crearCuentaModal.show();
        });
    });
</script>

@endsection
@endif
