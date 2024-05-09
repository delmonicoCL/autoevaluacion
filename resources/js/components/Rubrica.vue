<template>
  <div class="mb-5 mt-5">Componente RUBRICAS VUE</div>

  <div class="container mb-5">

      
    <div>
      <h2>Módulos</h2>
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="module in modules" :key="module.id">
            <td>{{ module.id }}</td>
            <td>{{ module.nombre }}</td>
            <td>{{ module.descripcion }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import * as bootstrap from "bootstrap";

export default {
  data() {
    return {
      modules: [],
      module: {},
    };
  },
 
  methods: {


    selectModulos() {
            const me = this;
            axios
            .get("usuariosmodulos").then((response) => {
                console.log(response)
                me.modules = response.data;
            });
        },

  },
};
</script>

<style>
/* Agrega estilos según sea necesario */
</style>
