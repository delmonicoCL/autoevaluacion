<template>
  
  <div class="mb-5">
   
    <table class="table">
      <thead>
        <tr>
          <th>ID-Modulosx</th>
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
                                @click="listaRubricas( modulo.Id_Modulo,idUsuario)"  >
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

<CompHijo :rubricas='rubricas' :idUsuario='idUsuario'></CompHijo>
  
</template>


<script>
import CompHijo from './rubrica-modulos.vue';


import axios from 'axios';
import * as bootstrap from "bootstrap";
export default {
  components: {
    CompHijo
  },
  data() {
    return {
      usersData: [],
      idUsuario: 0,
      modulos: [],
      rubricas: [],
      criterios: [],
      // usuaris_id: {},

      modulo:{},
      modulo_id:0,
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
          // console.log(me.modulos)
        })
        .catch(error => {

        });
    },
  

    listaRubricas(modulo_id, idUsuario) {
    const me = this;
    console.log(modulo_id, idUsuario);
    axios
        .get(`api/rubric/${modulo_id}/${idUsuario}`)
        .then((response) => {
            me.rubricas = response.data;
            console.log(response);
        })
        .catch((error) => {
            console.error(error.response.data); // Imprime el mensaje de error en la consola
            me.isError = true; // Establecer isError como true
            me.messageError = error.response.data.error;
        });
},


  },

  created() {

    this.ObtenerIdAlumno()

  },




};
</script>

<style>
/* Estilos opcionales para personalizar la apariencia de la tabla */
</style>
