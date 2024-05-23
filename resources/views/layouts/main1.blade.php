<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <title>
        @yield('titulo')
    </title>
    @vite(['resources/css/app.css', 'resources/css/app.scss', 'resources/js/app.js'])

    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>  --}}
    <link rel="stylesheet" href="{{ asset('css/autoevaluacion.css') }}" />
</head>

 {{-- @if (Auth::check())
    <script>
        console.log(@json(Auth::user()));
    </script>
@endif  --}}

<body>

   
    <div class="container">

        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">

            <div class="container-fluid">
                <!-- Logo -->
                <div class="col-md-1">
                    <a class="navbar-brand" href="#">
                        <img class="logo-barra" src="{{ asset('img/logo.png') }}" alt="Logo Politecnics"
                            style="width: 300px;" />
                    </a>
                </div>

                <!-- Botón de colapso para dispositivos pequeños -->
                <div class="col-md-2 text-center">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>

                <!-- Menú Datos maestros -->
                <div class="col-md-5 collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        @if (Auth::check() && Auth::user()->tipus_usuaris_id == '1')
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle font20" href="#" id="navbarDropdown1" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Datos Centrales
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown1">
                                    
                                    <li><a class="dropdown-item font18" href="{{ url('usuaris') }}">Usuarios</a></li>
                                    <li><a class="dropdown-item font18" href="{{ url('cicles') }}">Ciclos</a></li>
                                    <li><a class="dropdown-item font18" href="{{ url('moduls') }}">Módulos</a></li>
                                    <li><a class="dropdown-item font18" href="{{ url('ciclos') }}">CICLOS VUE </a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    
                                    <li><a class="dropdown-item" href="#">Resultados de aprendizaje</a></li>
                                    <li><a class="dropdown-item" href="#">Criterios evaluación</a></li>
                                </ul>
                            </li>
                        @endif

                        @if (Auth::check() && Auth::user()->tipus_usuaris_id == '2')
                            <!-- Menú Profesores -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle font" href="#" id="navbarDropdown2" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Profesores
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown2">
                                    <li><a class="dropdown-item" href="#">Asignar alumnos</a></li>
                                    <li><a class="dropdown-item" href="#">Resultados de aprendizaje</a></li>
                                    <li><a class="dropdown-item" href="#">Criterios evaluación</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="{{ url('rubricas-profesor') }}">Autoevaluación alumnos</a></li>
                                </ul>
                            </li>
                        @endif

                        @if (Auth::check() && Auth::user()->tipus_usuaris_id == '3')
                            <!-- Menú Alumnos -->
                            <li class="nav-item">
                                <a class="nav-link font" href="{{ url('rubricas') }}">Autoevaluación</a>
                            </li>
                        @endif

                    </ul>
                </div>

                <div class="col-md-2 collapse navbar-collapse" id="navbarNav">
                    <form class="col-md-12 d-md-flex justify-content-md-end botonLogin text-white"
                        role="search">
                        <ul class="navbar-nav ml-auto">
                            @if (Auth::check())
                                <li class="nav-link dropdown">
                                    <a class="nav-link dropdown-toggle text-white" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ Auth::user()->nom }} {{ Auth::user()->cognom }}
                                   
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item " href="{{ url('/logout') }}"> <i class="fa fa-sign-out"
                                                aria-hidden="true"></i> Logout </a>
                                    </div>
                                </li>
                            @else
                                <li class="nav-item botonLogin text-white">
                                    <a class="btn btn-primary botonLogin text-white"
                                        href="{{ url('/login') }}">Login</a>
                                </li>
                            @endif
                        </ul>
                    </form>
                </div>
            </div>



        </nav>


    </div>


    @yield('contenido')

    

</body>

</html>
