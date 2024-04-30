@extends('layouts.main1')

@section('contenido')
    {{-- {{$user->tipus_usuaris->tipus}} --}}

    <style>
        .carousel-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Hace que las imágenes ocupen todo el espacio del carrusel */
            border-radius: 25px;
        }
    </style>

    <div class="container mt-5">


        <div class="row justify-content-center">
            <div class="col-7 custom-margin d-flex justify-content-center align-items-center">
                <div id="carouselExampleAutoplaying" class="carousel slide w-75" data-bs-ride="carousel"
                    data-bs-interval="5000"> <!-- Intervalo de 5 segundos -->
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
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>


            <div class="col-5 custom-margin d-flex align-items-center justify-content-center">
               <H1 style="font-size: 60px;">BIENVENIDE</H1>
            </div>
            
            
            
        </div>
        </div>
    </div>
@endsection
