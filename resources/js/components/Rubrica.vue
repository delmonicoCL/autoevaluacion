
<template>
  <div class="mb-5 mt-5">Componente RUBRICAS VUE</div>
  <div>
    <h2>Tabla de Usuarios y Módulos</h2>
    <table class="table">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Código</th>
          <th>Siglas</th>
          <th>Nombre del Módulo</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="user in usersData" :key="user.id">
          <td>{{ user.nom }}</td>
          <td>{{ user.cognom }}</td>
          <td>{{ user.moduls[0].codi }}</td>
          <td>{{ user.moduls[0].sigles }}</td>
          <td>{{ user.moduls[0].nom }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>


<script>
import axios from 'axios';
import * as bootstrap from "bootstrap";
export default {
  data() {
    return {
      usersData: [] // Aquí puedes pasar los datos de los usuarios desde tu backend o donde los tengas
    };
  },
  // Método para obtener los datos de los usuarios desde el backend, por ejemplo, mediante una llamada a tu API
  created() {

    const me = this;
    axios
      .get("usuarioAutenticadoIDmodulo")
    // console.log(response)  
      .then(response => {
        me.usersData = response.data; // Asigna los datos de los usuarios a usersData
      })
      .catch(error => {
        console.error('Error al obtener los datos de los usuarios:', error);
      });

  }

};
</script>

<style>
/* Estilos opcionales para personalizar la apariencia de la tabla */
</style>
