<template lang="">

<tr v-for="rubrica in rubricas">
    <td>{{ rubrica.descripcio }}</td>

</tr>
    <div>
           <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Resultados</th>
                    <th>Criterios</th>
                    <th>Objetivos1</th>
                    <th>Objetivos2</th>
                    <th>Objetivos3</th>
                    <th>Evaluacion</th>
                </tr>
            </thead>
            <tbody>
               
                <tr>
                    <td rowspan="3">Resultado 1</td>
                    <td> Criterio Evaluacion 1</td>
                    <td>Objetivo 1</td>
                    <td>Objetivo 2</td>
                    <td>Objetivo 3</td>
                    <td>nota </td>
                </tr>
                <tr>
                    <td> Criterio Evaluacion 2</td>
                    <td>Objetivo 1</td>
                    <td>Objetivo 2</td>
                    <td>Objetivo 3</td>
                    <td>nota </td>
                </tr>
                <tr>
                    <td> Criterio Evaluacion 3</td>
                    <td>Objetivo 1</td>
                    <td>Objetivo 2</td>
                    <td>Objetivo 3</td>
                    <td>nota </td>
                </tr>
            </tbody>
        </table>
    </div>
        
    
</template>
<script>
export default {
  props: {
    rubricas : {}
  },
  methods: {
    // enviarMensajeAlPadre() {
    //   this.$emit('nom', 'Rebeca');
    // }
  }
}
</script>

<style lang="">

</style>