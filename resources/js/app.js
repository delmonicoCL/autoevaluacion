// import './bootstrap';

// import * as bootstrap from 'bootstrap'
// import { createApp } from 'vue'
// import ciclos from './components/Cicle.vue'

// createApp(ciclos).mount('ciclos');


// import "./bootstrap";
// import * as bootstrap from "bootstrap";
// import { createApp } from "vue";
// import ciclos from "./components/Cicle.vue";
// import rubrica from "./components/Rubrica.vue";
// import modulos from "./components/rubrica-modulos.vue";

// import rubriAlumnos from "./components/rubrica-alumnos.vue";
// import rubriProfesor from "./components/rubrica-profesor.vue";

// createApp(ciclos).mount("#ciclos");
// createApp(rubrica).mount("#rubricas");
// createApp(modulos).mount("#modulos");

// createApp(modulos).mount("#rubriAlumnos");
// createApp(modulos).mount("#rubriProfesor");

import { createApp } from "vue";
import ciclos from "./components/Cicle.vue";
import rubrica from "./components/Rubrica.vue";
import modulos from "./components/rubrica-modulos.vue";
import Alumnos from "./components/profesor-alumno.vue"; 
import Profesor from "./components/profesor.vue";

// Crear la instancia de Vue
const app = createApp({});

// Registrar todos los componentes
app.component("Ciclos", ciclos);
app.component("Rubrica", rubrica);
app.component("Modulos", modulos);
app.component("Alumnos", Alumnos); 
app.component("Profesor", Profesor);

// Montar la instancia de Vue en el contenedor principal
app.mount("#app");
