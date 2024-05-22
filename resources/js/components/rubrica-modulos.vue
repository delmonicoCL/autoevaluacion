<template>
    <div>
        <table>
            <thead>
                <tr>
                    <th class="text-white" style="background-color:#2299c6;">Resultadox</th>
                    <th class="text-white" style="background-color:#774992;">Criterios</th>
                    <th class="text-white" style="background-color:#ef882d;">Objetivos1</th>
                    <th class="text-white" style="background-color:#ef882d;">Objetivos2</th>
                    <th class="text-white" style="background-color:#ef882d;">Objetivos3</th>
                    <th class="text-white" style="background-color:#c80922;">NOTA</th>
                </tr>
            </thead>
            <tbody>
                <template v-for="rubrica in rubricas" :key="rubrica.id">
                    <tr v-if="rubrica.criteris_avaluacio && rubrica.criteris_avaluacio.length">
                        <td class="centered" :rowspan="rubrica.criteris_avaluacio.length">{{ rubrica.descripcio }}</td>
                        <td class="centered">{{ rubrica.criteris_avaluacio[0]?.descripcio }}</td>
                        <td class="centered">{{ rubrica.criteris_avaluacio[0]?.rubriques[0]?.descripcio ?? '' }}</td>
                        <td class="centered">{{ rubrica.criteris_avaluacio[0]?.rubriques[1]?.descripcio ?? '' }}</td>
                        <td class="centered">{{ rubrica.criteris_avaluacio[0]?.rubriques[2]?.descripcio ?? '' }}</td>
                        <td class="centered">
                            <input type="number" name="nota"
                                v-model="rubrica.criteris_avaluacio[0].alumnes_has_criteris_avaluacio[0].nota"
                                @change="actualizarNota(rubrica)">
                        </td>
                    </tr>
                    <tr v-for="(criterio, index) in rubrica.criteris_avaluacio.slice(1)" :key="criterio.id">
                        <td class="centered">{{ criterio.descripcio }}</td>
                        <td class="centered">{{ criterio.rubriques[0]?.descripcio ?? '' }}</td>
                        <td class="centered">{{ criterio.rubriques[1]?.descripcio ?? '' }}</td>
                        <td class="centered">{{ criterio.rubriques[2]?.descripcio ?? '' }}</td>
                        <td class="centered">
                            <input type="number" name="nota" v-model="criterio.alumnes_has_criteris_avaluacio[0].nota"
                                @change="actualizarNota(criterio)">
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: {
        rubricas: {
            type: Array,
            required: true
        },
        idUsuario: {
            type: Number,
            required: true
        }
    },
    methods: {
        actualizarNota(item) {
            const me = this;
            axios.put('/api/actualizar-nota', {
                usuaris_id: me.idUsuario,
                criteris_avaluacio_id: item.criteris_avaluacio[0].id,
                nota: item.criteris_avaluacio[0].alumnes_has_criteris_avaluacio[0].nota
            })
                .then(response => {
                    console.log('Nota actualizada con éxito');
                })
                .catch(error => {
                    console.error('Error actualizando la nota DESDE VUE:', error);
                });
        }
    }
}
</script>


<style scoped>
.centered {
    text-align: center;
}

table {
    border-collapse: collapse;
    width: 100%;
}

th,
td {
    border: 1px solid black;
    padding: 8px;
    text-align: center;
}

th {
    background-color: #f2f2f2;
}
</style>
