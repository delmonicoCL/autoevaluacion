// import './bootstrap';

// import * as bootstrap from 'bootstrap'
// import { createApp } from 'vue'
// import ciclos from './components/Cicle.vue'

// createApp(ciclos).mount('ciclos');


import "./bootstrap";
import * as bootstrap from "bootstrap";
import { createApp } from "vue";
import ciclos from "./components/Cicle.vue";
import rubrica from "./components/Rubrica.vue";

createApp(ciclos).mount("#ciclos");
createApp(rubrica).mount("#rubricas");
