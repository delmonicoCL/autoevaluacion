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
                    <td>
                        <a href="#" class="btn btn-enviado naranja text-white"
                            @click="listaRubricas(modulo.Id_Modulo, idUsuario)">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i> Editar
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>

        <UsuariosDropdown :usuarios="usuarios" v-if="usuarios.length > 0"
            @usuario-seleccionado="manejarUsuarioSeleccionado"></UsuariosDropdown>
        <ResultadosRubrica :rubricas="rubricas" v-if="rubricas.length > 0"></ResultadosRubrica>
    </div>
</template>

<script>
import UsuariosDropdown from './profesor-alumno.vue';
import ResultadosRubrica from './ResultadosRubrica.vue';
import axios from 'axios';

export default {
    components: {
        UsuariosDropdown,
        ResultadosRubrica
    },
    data() {
        return {
            idUsuario: 0,
            modulos: [],
            usuarios: [],
            rubricas: []
        };
    },
    methods: {
        ObtenerIdAlumno() {
            axios.get("ObtenerIdAlumno")
                .then(response => {
                    this.idUsuario = response.data.id;
                    this.listarModulos();
                })
                .catch(error => {
                    console.error(error);
                });
        },
        listarModulos() {
            axios.get(`api/usuarioID/${this.idUsuario}`)
                .then(response => {
                    this.modulos = response.data;
                })
                .catch(error => {
                    console.error(error);
                });
        },
        listaRubricas(modulo_id, idUsuario) {
            axios.get(`api/rubric/${modulo_id}/${idUsuario}`)
                .then(response => {
                    this.rubricas = response.data;
                    this.listarUsuarios(modulo_id);
                })
                .catch(error => {
                    console.error(error);
                });
        },
        listarUsuarios(modulo_id) {
            axios.get(`api/modulos/${modulo_id}/usuarios`)
                .then(response => {
                    this.usuarios = response.data.filter(usuario => usuario.tipus_usuaris_id === 3);
                })
                .catch(error => {
                    console.error(error);
                });
        },
        manejarUsuarioSeleccionado(usuarioId) {
            // Pasamos el idUsuario seleccionado a listaRubricas con el modulo_id que tenemos
            const moduloId = this.modulos.find(mod => mod.Id_Modulo === usuarioId)?.Id_Modulo || this.modulos[0].Id_Modulo;
            this.listaRubricas(moduloId, usuarioId);
        }
    },
    created() {
        this.ObtenerIdAlumno();
    }
};
</script>

<style>
/* Estilos opcionales para personalizar la apariencia */
</style>
