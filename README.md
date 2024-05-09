Instalar VUE
Por consola: npm i vue

Instalar NPM VUE LOADER: (para bajar paquetes necesarios)
Por consola: npm i vue-loader

Compliar VUE
Por consola: npm i @vitejs/plugin-vue

Dentro de Resources/js creamos la carpeta components (que contrendra mis compones VUE)

Creo el componenente Rubrica.vue, luego dentro de el, escribo con un plugins instalado vue-Init y me instala la estrura de codigo basica

Nos vamos al archivo Resources/js/app.js

import { createApp } from "vue";
import rubrica from "./components/Rubrica.vue";
createApp(rubrica).mount("#rubricas");

Nos vamos a las vistas (views), creamos la carpeta rubrica y dentro de ella el archivo index.blade.php

Creamos este documento:

@extends('layouts/main1')

@section('contenido')

    <div class="container mt-5">
           TEXTO DESDE VENTANA BLADE
            <div id="rubricas"></div> // este ID es la llamada al componente
    </div>

    
@endsection

Luego nos vamos a web.php y creamos la ruta:

Route::get('rubricas', function () {
    return view('rubrica.index');

});

Luego nos vamos a la vista que llamara al componente VUE, en este caso mi vista main1.blade.php



