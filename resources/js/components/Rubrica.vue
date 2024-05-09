<template>
  <div class="mb-5 mt-5">Componente RUBRICAS VUE</div>

  <div class="container mb-5">
    <h2>MODELO ROW/COLUM</h2>
      
    <div>
      <h2>Mis Módulos</h2>
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

export default {
  data() {
    return {
      modules: [],
    };
  },
  mounted() {
    // Llama a la API para obtener los módulos del usuario autenticado
    this.getModulesForAuthenticatedUser();
  },
  methods: {
    async getModulesForAuthenticatedUser() {
      try {
        // Realiza una solicitud GET a la API
        const response = await axios.get('moduloUsuario');

      
       

        // Asigna los módulos obtenidos a la variable 'modules'
        this.modules = response.data.moduls;
      } catch (error) {
        console.error('Error al obtener los módulos:', error);
      }
    },
  },
};
</script>

<style>
.red {
    background-color: red;
}
.green {
    background-color: green;
}
.blue {
    background-color: blue;
}
.yellow {
    background-color: yellow;
}
.orange {
    background-color: orange;
}
.purple {
    background-color: purple;
}
.pink {
    background-color: pink;
}
.cyan {
    background-color: cyan;
}
.teal {
    background-color: teal;
}
.brown {
    background-color: brown;
}
.bordered {
    border: 1px solid black;
}
</style>
