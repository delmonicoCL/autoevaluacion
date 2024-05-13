<template>
    <div class="container mt-5">
        <div>Desde Componente VUE</div>

        <div class="">
            <h2>CICLOS</h2>
        </div>

        <div class="col-8">
            <button class="btn celeste text-white" @click="showForm()">
                <i class="fa fa-plus-circle" aria-hidden="true"></i> Nuevo Ciclo
            </button>
        </div>

        <!-- Tabla de ciclos -->
        <table class="mt-2 table table-hover table-borderless">
            <thead class="table-dark lila">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Siglas</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Borrar</th>
                    <th scope="col">Editar</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="cicleFiltrado in ciclos">
                    <td>{{ cicleFiltrado.id }}</td>
                    <td>{{ cicleFiltrado.sigles }}</td>
                    <td>{{ cicleFiltrado.descripcio }}</td>

                    <td>
                        <div class="form-check">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                value="actiu"
                                name="actiu"
                                :checked="cicleFiltrado.actiu"
                                disabled
                            />
                            <label class="form-check-label" for="actiu">
                            </label>
                        </div>
                    </td>

                    <td class="text-center">
                        <div class="col-8">
                            <a
                                href="#"
                                class="btn btn-eliminar naranja text-white"
                                @click="confirmDelete(cicleFiltrado)"
                            >
                                <i
                                    class="fa fa-plus-circle"
                                    aria-hidden="true"
                                ></i>
                                Borrar
                            </a>
                        </div>
                    </td>

                    <td>
                        <div class="col-8">
                            <a
                                href="#"
                                class="btn btn-editar naranja text-white"
                                @click="editarCicle(cicleFiltrado)"
                            >
                                <i
                                    class="fa fa-plus-circle"
                                    aria-hidden="true"
                                ></i>
                                Editar
                            </a>
                        </div>

                        <!-- MODAL BORRAR VUE -->
                        <div class="modal" tabindex="-1" id="deleteModal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            Modal BORRAR VUE
                                        </h5>
                                        <button
                                            type="button"
                                            class="btn-close"
                                            data-bs-dismiss="modal"
                                            aria-label="Close"
                                        ></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>
                                            Estas seguro de querer borrar el
                                            CICLO
                                            <strong>{{
                                                cicleFiltrado.nom
                                            }}</strong
                                            >.
                                        </p>
                                        <span
                                            v-if="isError"
                                            class="badge text-bg-warning"
                                            >{{ messageError }}</span
                                        >
                                    </div>
                                    <div class="modal-footer">
                                        <button
                                            type="button"
                                            class="btn btn-secondary"
                                            data-bs-dismiss="modal"
                                        >
                                            Cerrar
                                        </button>
                                        <button
                                            type="button"
                                            class="btn btn-danger"
                                            @click="deleteCiclo()"
                                        >
                                            Borrar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <div
            class="container row d-flex justify-content-between align-items-center"
        >
            <div class="col-2">
                <!-- <div>
                        {{ $ciclos->links() }}
                    </div> -->
            </div>
        </div>
    </div>

    <!-- MODAL AGREGAR VUE -->
    <div
        class="modal fade"
        id="agregarModal"
        tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <h4 v-if="insert" class="modal-title" id="modalBorradoLabel"> Nuevo Ciclo </h4>
                    <h4 v-else class="modal-title" id="modalBorradoLabel"> Modificar Ciclo </h4>
                    <button
                        type="button"
                        title="Cerrar Ventana"
                        class="btn-cerrar"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="nombre">SIGLAS</label>
                            <input
                                type="text"
                                class="form-control"
                                id="sigles"
                                name="sigles"
                                v-model="cicleFiltrado.sigles"
                                placeholder="Ingrese SIGLA ciclo"
                                required
                            />
                        </div>
                        <div class="form-group">
                            <label for="nombre">Descripcion</label>
                            <input
                                type="text"
                                class="form-control"
                                id="descripcio"
                                name="descripcio"
                                v-model="cicleFiltrado.descripcio"
                                placeholder="Ingrese descripcion"
                                required
                            />
                        </div>

                        <!-- <div class="form-group">
                            <div class="form-check mt-3">
                                <label class="form-check-label me-5" for="actiu"
                                    >Estado</label
                                >
                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    id="actiu"
                                    name="actiu"
                                    v-model="cicleFiltrado.actiu"
                                    :checked="cicleFiltrado.actiu"                               
                                /> 
                             
                            </div>
                        </div> -->

                        <div class="form-group">
                            <label for="actiu">Estado:</label>
                            <input type="checkbox" class="form-check-input" id="actiu" name="actiu" v-model="cicleFiltrado.actiu" :checked="cicleFiltrado.actiu">
                            <div class="clearfix"></div>
                        </div>


                        <div class="modal-footer mt-4">
                            <button v-if="insert"
                                
                                title="Guardar cambios"
                                class="btn-guardar"
                                @click="insertCiclo()"
                            >
                                Crear
                            </button>
                            <button v-else
                               
                                title="Guardar cambios"
                                class="btn-guardar"
                                @click="updateCiclo()"
                            >
                                Modificar
                            </button>
                        </div>
                    </form>
                    <span v-if="isError" class="badge text-bg-warning">{{
                        messageError
                    }}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import * as bootstrap from "bootstrap";
export default {
    data() {
        return {
            ciclos: [],
            myModal: {},
            cicleFiltrado: {},
            messageError: "",
            isError: false,
            insert: false,
        };
    },
    methods: {
        showForm() {
            this.insert = true
            this.isError = false;
            this.myModal = new bootstrap.Modal("#agregarModal");
            this.myModal.show();
        },

        editarCicle(cicleFiltrado) {
            this.insert = false
            // this.isError = false;
            this.cicleFiltrado = cicleFiltrado
            this.myModal = new bootstrap.Modal("#agregarModal");
            this.myModal.show();
        },

        updateCiclo(){
            const me = this;
            axios
                .put('cicle/' + me.cicleFiltrado.id, me.cicleFiltrado)
                .then((response) => {
                    console.log("Registro Insertado correctamente");
                    // me.isError = false;
                    me.selectCicles();
                    me.myModal.hide();
                })
                .catch((error) => {
                    console.error(error.response.data); // Imprime el mensaje de error en la consola
                    me.isError = true; // Establecer isError como true
                    me.messageError = error.response.data.error;
                });

        },

        insertCiclo() {
            const me = this;
            axios
                .post("cicle", me.cicleFiltrado)
                .then((response) => {
                    console.log("Registro Insertado correctamente");
                    // me.isError = false;
                    me.selectCicles();
                    me.myModal.hide();
                })
                .catch((error) => {
                    console.error(error.response.data); // Imprime el mensaje de error en la consola
                    me.isError = true; // Establecer isError como true
                    me.messageError = error.response.data.error;
                });
        },

        selectCicles() {
            const me = this;
            axios
            .get("cicle").then((response) => {
                //console.log(response)
                me.ciclos = response.data;
            });
        },

        insertCiclo() {
            const me = this;
            axios
                .post("cicle", me.cicleFiltrado)
                .then((response) => {
                    console.log("Registro Insertado correctamente");
                    me.isError = false;
                    me.selectCicles();
                    me.myModal.hide();
                })
                .catch((error) => {
                    console.error(error.response.data); // Imprime el mensaje de error en la consola
                    me.isError = true; // Establecer isError como true
                    me.messageError = error.response.data.error;
                });
        },

        confirmDelete(cicleFiltrado) {
            this.isError = false;
            this.cicleFiltrado = cicleFiltrado;
            this.myModal = new bootstrap.Modal("#deleteModal");
            this.myModal.show();
        },
        deleteCiclo() {
            const me = this;
            axios
                .delete(`cicle/${me.cicleFiltrado.id}`)
                .then((response) => {
                    console.log("Registro eliminado correctamente");
                    me.isError = false; // Establecer isError como false
                    me.selectCicles();
                    me.myModal.hide();
                })
                .catch((error) => {
                    console.error(error.response.data); // Imprime el mensaje de error en la consola
                    me.isError = true; // Establecer isError como true
                    me.messageError = error.response.data.error;
                });
        },
    },
    created() {
        this.selectCicles();
    },
};
</script>

<style scoped>
.form-check {
    display: flex;
    justify-content: center; /* Centra horizontalmente */
}

.form-check input[type="checkbox"] {
    /* Aquí puedes ajustar el tamaño del checkbox */
    width: 30px; /* Ajusta el ancho según tus necesidades */
    height: 30px; /* Ajusta la altura según tus necesidades */
}
.form-check-input[type="checkbox"] {
    /* Aquí puedes ajustar el tamaño del checkbox */
    width: 30px; /* Ajusta el ancho según tus necesidades */
    height: 30px; /* Ajusta la altura según tus necesidades */
}
</style>
