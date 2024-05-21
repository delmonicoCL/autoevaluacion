@extends('layouts/main1')

@section('contenido')
    <div class="container mt-5">
        <H1>TUS MODULOS RUBRICA profesor </H1>

        <div id="app">
          <div id="rubricas">
            <Rubrica></Rubrica>
        </div>
          {{-- <div id="app">
            <Rubrica></Rubrica> <!-- Usa RubriAlumnos, asegurándote de que coincide con el nombre registrado -->
        </div> --}}
    </div>

    <div class="container mt-5">
    </div>
<script type="module" src="/resources/js/app.js"></script> <!-- Asegúrate de usar type="module" -->
@endsection
