<template>
  <main class="main">
    <h1>Categoría</h1>
    <v-app id="inspire">
      <v-data-table
        :search="search"
        :headers="headers"
        :items="desserts"
        sort-by="calories"
        class="elevation-1"
      >
        <template v-slot:top>
          <v-toolbar flat>
            <v-toolbar-title>
              <v-text-field
                v-model="search"
                append-icon="mdi-magnify"
                label="Buscar"
                single-line
                hide-details
              ></v-text-field>
            </v-toolbar-title>
            <v-divider class="mx-4" inset vertical></v-divider>
            <v-spacer></v-spacer>

            <v-dialog v-model="dialog" max-width="500px">
              <template v-slot:activator="{ on, attrs }">
                <v-btn
                  dark
                  class="mb-2 myboton"
                  v-bind="attrs"
                  v-on="on"
                >
                  Nuevo
                </v-btn>
              </template>
              <v-card>
                <v-card-title>
                  <span class="text-h5">{{ formTitle }}</span>
                  <!-- <h4 class="modal-title">{{formTitle}}</h4> -->
                </v-card-title>

                <v-card-text>
                  <!-- VENTANA MODAL -->
                  <v-container>
                    <v-row>
                      <v-col cols="12" sm="12" md="12">
                        <v-text-field
                          v-model="editedItem.nombre"
                          label="Nombre"
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12" sm="12" md="12">
                        <v-text-field
                          v-model="editedItem.descripcion"
                          label="Descripción"
                        ></v-text-field>
                      </v-col>
                    </v-row>
                  </v-container>
                  <!-- MENSAJE DE ERROR -->
                  <div v-show="errorCategoria" class="form-group row div-error">
                    <div class="text-center text-error">
                      <div
                        v-for="error in errorMostrarMsjCategoria"
                        :key="error"
                        v-text="error"
                      ></div>
                    </div>
                  </div>
                  <!-- FIN MENSAJE DE ERROR -->
                </v-card-text>

                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn color="blue darken-1" text @click="close">
                    Cancel
                  </v-btn>

                  <v-btn color="blue darken-1" text @click="save">{{
                    nuevActu
                  }}</v-btn>
                </v-card-actions>
              </v-card>
            </v-dialog>
            <!-- FIN VENTANA MODAL -->

            <v-dialog v-model="dialogDelete" max-width="500px">
              <v-card>
                <v-card-title class="text-h5"
                  >Are you sure you want to delete this item?</v-card-title
                >
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn color="blue darken-1" text @click="closeDelete"
                    >Cancel</v-btn
                  >
                  <v-btn color="blue darken-1" text @click="deleteItemConfirm"
                    >OK</v-btn
                  >
                  <v-spacer></v-spacer>
                </v-card-actions>
              </v-card>
            </v-dialog>
          </v-toolbar>
        </template>

        <template v-slot:item.opciones="{ item }">
          <v-icon
            color="orange darken-2"
            small
            class="mr-2"
            @click="editItem(item)"
          >
            mdi-pencil
          </v-icon>
          <!-- <v-icon small class="mr-2" @click="editItem(item)"> mdi-pencil </v-icon> -->
          <!-- <v-btn small class="mr-2" @click="editItem(item)">
          <i class="icon-pencil"></i>
        </v-btn> -->
          <!-- <button type="button" class="btn btn-warning btn-sm mr-2" @click="editItem(item)">
          <i class="icon-pencil"></i>
        </button>
        <button type="button" class="btn btn-danger btn-sm" @click="deleteItem(item)">
            <i class="icon-trash"></i>
        </button> -->
          <template v-if="item.condicion">
            <v-icon
              color="red lighten-2"
              small
              @click="desactivarCategoria(item.id)"
            >
              mdi-delete
            </v-icon>
          </template>
          <template v-else>
            <v-icon
              color="blue lighten-2"
              small
              @click="activarCategoria(item.id)"
            >
              mdi-checkbox-marked-circle
            </v-icon>
          </template>
        </template>

        <template v-slot:item.condicion="{ item }">
          <div v-if="item.condicion == 1">
            <span class="badge badge-success">Activo</span>
          </div>
          <div v-else>
            <span class="badge badge-danger">Desactivo</span>
          </div>
        </template>

        <template v-slot:no-data>
          <v-btn color="primary" @click="initialize"> Reset </v-btn>
        </template>
      </v-data-table>
    </v-app>
  </main>
</template>

<script>
export default {
  data() {
    return {
      dialog: false,
      dialogDelete: false,
      search: "",
      headers: [
        { text: "Opciones", value: "opciones", sortable: false },
        { text: "Nombre", align: "start", value: "nombre" },
        { text: "Descripción", value: "descripcion" },
        { text: "Condicion", value: "condicion", sortable: false },
      ],
      desserts: [],
      editedIndex: -1,
      editedItem: {
        id: 0,
        nombre: "",
        descripcion: "",
      },
      defaultItem: {
        nombre: "",
        descripcion: "",
      },
      errorCategoria: 0,
      errorMostrarMsjCategoria: [],
      tipoAccion: 0,
    };
  },

  computed: {
    formTitle() {
      return this.editedIndex === -1
        ? "Registrar Categoría"
        : "Actualizar Categoría";
    },
    nuevActu() {
      return this.editedIndex === -1 ? "Guardar" : "Actualizar";
    },
  },

  watch: {
    dialog(val) {
      val || this.close();
    },
    dialogDelete(val) {
      val || this.closeDelete();
    },
  },

  created() {
    this.initialize();
  },

  methods: {
    initialize() {
      let me = this;
      axios
        .get("/categoria")
        .then(function (response) {
          // handle success
          console.log(response.data);
          me.desserts = response.data;
        })
        .catch(function (error) {
          // handle error
          console.log(error);
        });
    },
    desactivarCategoria(id) {
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: "btn btn-success",
          cancelButton: "btn btn-danger",
        },
        buttonsStyling: false,
      });

      swalWithBootstrapButtons
        .fire({
          title: "Esta seguro de desactivar esta categoría?",
          icon: "warning",
          showCancelButton: true,
          confirmButtonText: "Aceptar!",
          cancelButtonText: "Cancelar!",
          reverseButtons: true,
        })
        .then((result) => {
          if (result.isConfirmed) {
            let me = this;
            axios
              .put("/categoria/desactivar", {
                id: id,
              })
              .then(function (response) {
                me.initialize();
              })
              .catch(function (error) {
                // handle error
                console.log(error);
              });

            swalWithBootstrapButtons.fire(
              "Desactivado!",
              "El registro ha sido desactivado con éxito.",
              "success"
            );
          } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
          ) {
          }
        });
    },
    activarCategoria(id) {
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: "btn btn-success",
          cancelButton: "btn btn-danger",
        },
        buttonsStyling: false,
      });

      swalWithBootstrapButtons
        .fire({
          title: "Esta seguro de activar esta categoría?",
          icon: "warning",
          showCancelButton: true,
          confirmButtonText: "Aceptar!",
          cancelButtonText: "Cancelar!",
          reverseButtons: true,
        })
        .then((result) => {
          if (result.isConfirmed) {
            let me = this;
            axios
              .put("/categoria/activar", {
                id: id,
              })
              .then(function (response) {
                me.initialize();
              })
              .catch(function (error) {
                // handle error
                console.log(error);
              });

            swalWithBootstrapButtons.fire(
              "Activado!",
              "El registro ha sido activado con éxito.",
              "success"
            );
          } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
          ) {
          }
        });
    },

    editItem(item) {
      this.editedIndex = this.desserts.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },
    registrarCategoria() {
      if (this.validarCategoria()) {
        return;
      }
      let me = this;
      axios
        .post("/categoria/registrar", {
          nombre: me.editedItem.nombre,
          descripcion: me.editedItem.descripcion,
        })
        .then(function (response) {
          // me.cerrarModal();
          me.initialize();
        })
        .catch(function (error) {
          // handle error
          console.log(error);
        });
    },
    actualizarCategoria() {
      // if(this.validarCategoria()){
      //     return;
      // }
      let me = this;
      axios
        .put("/categoria/actualizar", {
          nombre: me.editedItem.nombre,
          descripcion: me.editedItem.descripcion,
          id: me.editedItem.id,
        })
        .then(function (response) {
          // me.cerrarModal();
          me.initialize();
        })
        .catch(function (error) {
          // handle error
          console.log(error);
        });
    },
    validarCategoria() {
      let me = this;
      this.errorCategoria = 0;
      this.errorMostrarMsjCategoria = [];

      if (!me.editedItem.nombre)
        this.errorMostrarMsjCategoria.push(
          "El nombre de la categoría no puede estar vacío"
        );

      if (this.errorMostrarMsjCategoria.length) this.errorCategoria = 1;

      return this.errorCategoria;
    },
    deleteItem(item) {
      this.editedIndex = this.desserts.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialogDelete = true;
    },

    deleteItemConfirm() {
      this.desserts.splice(this.editedIndex, 1);
      this.closeDelete();
    },

    close() {
      this.dialog = false;
      this.errorMostrarMsjCategoria = [];
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    closeDelete() {
      this.dialogDelete = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    save() {
      if (this.editedIndex > -1) {
        Object.assign(this.editedItem);

        if (this.validarCategoria()) {
          return;
        }
        this.actualizarCategoria();
      } else {
        // this.desserts.push(this.editedItem);
        if (this.validarCategoria()) {
          return;
        }
        this.registrarCategoria();
      }
      this.close();
    },
  },
};
</script>
<style scoped>
  .myboton{
    border-radius: 50px 0px !important;
    width: 155px!important; 
    background: #0e738d !important;
  }
</style>