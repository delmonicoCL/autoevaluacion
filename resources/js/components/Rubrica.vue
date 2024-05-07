<template>
    <div class="mb-5 mt-r">Componente RUBRICAS VUE</div>

    <div class="container mb-5">
    <h2>MODELO ROW/COLUM</h2>
        <div class="row">
            <div id="resultado" class="col-md-2 red">RESULTADO EVALUACION</div>
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-6 blue text-white" style="height: 90px">
                        Criterio Evaluacion 1
                    </div>
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col yellow">Rubrica 1</div>
                            <div class="col orange">Rubrica 2</div>
                            <div class="col purple text-white">Rubrica 3</div>
                        </div>
                    </div>
                    <div class="col-md-1 teal text-white">NOTA 2</div>
                </div>
                <div class="row">
                    <div class="col-md-6 pink" style="height: 90px">
                        Criterio Evaluacion 2
                    </div>
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col yellow" style="height: 90px">
                                Rubrica 1
                            </div>
                            <div class="col orange">Rubrica 2</div>
                            <div class="col purple text-white">Rubrica 3</div>
                        </div>
                    </div>
                    <div class="col-md-1 teal text-white" style="height: 90px">
                        NOTA 1
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 cyan">Criterio Evaluacion 3</div>
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col yellow">Rubrica 1</div>
                            <div class="col orange">Rubrica 2</div>
                            <div class="col purple text-white">Rubrica 3</div>
                        </div>
                    </div>
                    <div class="col-md-1 teal text-white">NOTA 3</div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <h2>MODELO TABLA (th, th, td)</h2>
        <table class="table table-bordered">
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
                    <td rowspan="3">Entendre arquitectura client/servidor i coneixer el principals llenguatgs i eines de programació en entorn servidor.</td>
                    <td>Diferenciar l'execució de codi al servidor i al client web, i les diferents arquitectures d'entorn servidor.</td>
                    <td>Entenc la diferència entre l'execució de codi a un servidor i a un client web.ber</td>
                    <td>A més, conec les problemàtiques que poden sorgir a l'hora d'executar codi en una o altra banda.</td>
                    <td>A més, donada una funcionalitat, Soc capaç de saber si s'ha d'implementar el codi al servidor o al client web.</td>
                    <td>nota 3</td>
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
                <tr>
                    <td rowspan="3">Resultado 2</td>
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
export default {};
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
