<!DOCTYPE html>
<html lang="es">
    <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>
                @yield('titulo')
            </title>
             @vite( [ "resources/css/app.css", "resources/css/app.scss", "resources/js/app.js",],) 

            {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> --}}



           <link rel="stylesheet" href="{{ asset('css/autoevaluacion.css') }}" />
    </head>
    <body>

        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
                <div class="container">
                    <!-- Logo -->
                     <a class="navbar-brand" href="#">
                         <img class="logo-barra" src="{{ asset('img/logo.png') }}" alt="Logo Politecnics" style="width: 300px;" />
                    </a>
                    <!-- Botón de colapso para dispositivos pequeños -->
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <!-- Contenedor de los menús -->
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <!-- Menú Datos maestros -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Datos XXX
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown1">
                                    <li><a class="dropdown-item" href="#">Tipo usuarios</a></li>
                                    <li><a class="dropdown-item" href="{{ url ('usuaris')}}">Usuarios</a></li>    
                                    <li><a class="dropdown-item" href="#">Ciclos</a></li>
                                    <li><a class="dropdown-item" href="#">Módulos</a></li>
                                    <li><a class="dropdown-item" href="#">Asignar Profesores</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Asignar alumnos</a></li>
                                    <li><a class="dropdown-item" href="#">Resultados de aprendizaje</a></li>
                                    <li><a class="dropdown-item" href="#">Criterios evaluación</a></li>
                                </ul>
                            </li>

                            <!-- Menú Profesores -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button"
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
                                    <li><a class="dropdown-item" href="#">Autoevaluación alumnos</a></li>
                                </ul>
                            </li>

                            <!-- Menú Alumnos -->
                            <li class="nav-item">
                                <a class="nav-link" href="#">Alumnos</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Nombre en la parte derecha -->
                    <span class="navbar-text">
                        Nombre Usuario
                    </span>
                </div>
            </nav>
        </div>
       
            @yield('contenido')

    </body>

</html>