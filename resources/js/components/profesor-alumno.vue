<template>
    <div>
        <h2>Selecciona </h2>
        <select class="form-select" @change="seleccionarUsuario($event)">
            <option v-for="usuario in usuarios" :key="usuario.id" :value="usuario.id">
                {{ usuario.nom_usuari }} - {{ usuario.nom }} {{ usuario.cognom }}
            </option>
        </select>
    </div>
</template>

<script>
export default {
    name: 'UsuariosDropdown',
    props: {
        usuarios: {
            type: Array,
            required: true
        }
    },
    methods: {
        seleccionarUsuario(event) {
            this.$emit('usuario-seleccionado', event.target.value);
        }
    }
}
</script>

<style scoped>
.form-select {
    width: 100%;
    padding: 8px;
    margin: 10px 0;
    border-radius: 4px;
    border: 1px solid #ddd;
}
</style>
