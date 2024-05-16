<template>
  
  <div class="mb-5">
   
    <table class="table">
      <thead>
        <tr>
          <th>ID-Modulos</th>
          <th>Código</th>
          <th>Siglas</th>
          <th>Nombre del Módulo</th>
          <th>Autoevaluar</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(modulo, index) in modulos" :key="index">
          <td>{{ modulo.Id_Modulo }}</td>
          <td>{{ modulo.codis }}</td>
          <td>{{ modulo.sigles }}</td>
          <td>{{ modulo.nom }}</td>
          <td >
                            <a
                                href="#"
                                class="btn btn-enviado naranja text-white"
                                @click="editarCicle(cicleFiltrado)"
                            >
                                <i
                                    class="fa fa-plus-circle"
                                    aria-hidden="true"
                                ></i>
                                Editar
                            </a>
                       
                        
                    </td>
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
      usersData: [],
      idUsuario: 0,
      modulos: []
    };
  },
  methods: {

    ObtenerIdAlumno() {
      const me = this;
      axios
        .get("ObtenerIdAlumno")
        // console.log(response)  
        .then(response => {
          me.idUsuario = response.data.id; // Asigna los datos de los usuarios a usersData
          me.listarModulos()
          //  console.log(me.idUsuario)  

        })
        .catch(error => {

        });
    },

    listarModulos() {
      const me = this;
      axios
        .get("api/usuarioID/" + me.idUsuario)

        .then(response => {
          me.modulos = response.data
          console.log(me.modulos)
        })
        .catch(error => {

        });
    }

  },

  created() {

    this.ObtenerIdAlumno()

  },




};
</script>

<style>
/* Estilos opcionales para personalizar la apariencia de la tabla */
</style>
