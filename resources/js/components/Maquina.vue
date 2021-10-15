<template>
  <main class="main">
    <h1>Maquinaria</h1>
    <!-- <ol class="breadcrumb">
      <li class="breadcrumb-item">Máquinas</li>
    </ol> -->
    {{ selectAceiteModel }}
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
                <v-btn dark class="mb-2 myboton" v-bind="attrs" v-on="on">
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
                          v-model="editedItem.tipo"
                          label="Tipo"
                        ></v-text-field>
                      </v-col>

                      <v-col cols="12" sm="12" md="12">
                        <v-text-field
                          v-model="editedItem.marca"
                          label="Marca"
                        ></v-text-field>
                      </v-col>

                      <v-col cols="12" sm="12" md="12">
                        <v-text-field
                          v-model="editedItem.modelo"
                          label="Modelo"
                        ></v-text-field>
                      </v-col>

                      <v-col cols="12" sm="12" md="12">
                        <v-text-field
                          v-model="editedItem.tag"
                          label="Tag"
                        ></v-text-field>
                      </v-col>

                      <v-col cols="12" sm="12" md="12">
                        <v-text-field
                          v-model="editedItem.volaceite"
                          label="Vol. Aceite (TLS)"
                        ></v-text-field>
                      </v-col>

                      <!-- <v-col cols="12" sm="12" md="12">
                        <v-text-field
                          v-model="editedItem.idaceite"
                          label="Tipo Aceite"
                        ></v-text-field>
                      </v-col> -->
                      <!-- v-on:change="changeRoute(`${select.id}`)" -->
                      <v-col cols="12" sm="12" md="12">
                        <v-select
                          :items="arrayAceite"
                          v-model="selectAceiteModel"
                          single-line
                          item-text="modelo"
                          item-value="id"
                          return-object
                          placeholder="Selecciona.."
                        ></v-select>
                      </v-col>
                    </v-row>
                  </v-container>
                  <!-- MENSAJE DE ERROR -->
                  <div v-show="errorCliente" class="form-group row div-error">
                    <div class="text-center text-error">
                      <div
                        v-for="error in errorMostrarMsjCliente"
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
          <!-- <template v-if="item.condicion">
            <v-icon
              color="red lighten-2"
              small
              @click="desactivarCliente(item.id)"
            >
              mdi-delete
            </v-icon>
          </template> -->
          <!-- <template v-else>
            <v-icon
              color="blue lighten-2"
              small
              @click="activarCliente(item.id)"
            >
              mdi-checkbox-marked-circle
            </v-icon>
          </template> -->
        </template>

        <!-- <template v-slot:item.condicion="{ item }">
          <div v-if="item.condicion == 1">
            <span class="badge badge-success">Activo</span>
          </div>
          <div v-else>
            <span class="badge badge-danger">Desactivo</span>
          </div>
        </template> -->

        <template v-slot:no-data>
          <!-- <v-btn color="primary" @click="initialize"> Reset </v-btn> -->
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

      selectAceiteModel: {},
      arrayAceite: [],

      headers: [
        { text: "Opciones", value: "opciones", sortable: false },
        { text: "Tipo", align: "start", value: "tipo" },
        { text: "Marca", align: "start", value: "marca" },
        { text: "Modelo", align: "start", value: "modelo" },
        { text: "Tag", align: "start", value: "tag" },
        { text: "Vol. Aceite (LTS)", align: "start", value: "volaceite" },
        { text: "Tipo Aceite", align: "start", value: "AceiteMod" },
      ],
      desserts: [],
      editedIndex: -1,
      editedItem: {
        id: 0,
        tipo: "",
        marca: "",
        modelo: "",
        tag: "",
        volaceite: "",
        idaceite: "",
      },
      defaultItem: {
        tipo: "",
        marca: "",
        modelo: "",
        tag: "",
        volaceite: "",
        idaceite: "",
      },
      errorCliente: 0,
      errorMostrarMsjCliente: [],
      tipoAccion: 0,
    };
  },

  computed: {
    formTitle() {
      return this.editedIndex === -1
        ? "Registrar Máquina"
        : "Actualizar Máquina";
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
    this.selectAceite();
  },

  methods: {
    initialize() {
      let me = this;
      axios
        .get("/maquina")
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
    selectAceite() {
      let me = this;
      axios
        .get("/aceite/selectAceite")
        .then(function (response) {
          // handle success
          // console.log(response.data.aceites);
          me.arrayAceite = response.data.aceites;
        })
        .catch(function (error) {
          // handle error
          console.log(error);
        });
    },
    editItem(item) {
      this.editedIndex = this.desserts.indexOf(item);
      this.editedItem = Object.assign({}, item);

      console.log(this.editedItem);
      let idaceite = this.editedItem.idaceite;
      let AceiteMod = this.editedItem.AceiteMod;

      this.selectAceiteModel =  { id: idaceite, AceiteMod: AceiteMod };

      this.dialog = true;
    },
    registrarCliente() {
      if (this.validarCliente()) {
        return;
      }
      let me = this;
      axios
        .post("/maquina/registrar", {
          idaceite: me.selectAceiteModel.id,
          tipo: me.editedItem.tipo,
          marca: me.editedItem.marca,
          modelo: me.editedItem.modelo,
          tag: me.editedItem.tag,
          volaceite: me.editedItem.volaceite,
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
    actualizarCliente() {
      // if(this.validarCliente()){
      //     return;
      // }
      let me = this;
      axios
        .put("/maquina/actualizar", {
          // compania: me.editedItem.estacion,
          id: me.editedItem.id,
          idaceite: me.selectAceiteModel.id,
          tipo: me.editedItem.tipo,
          marca: me.editedItem.marca,
          modelo: me.editedItem.modelo,
          tag: me.editedItem.tag,
          volaceite: me.editedItem.volaceite,
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
    validarCliente() {
      let me = this;
      this.errorCliente = 0;
      this.errorMostrarMsjCliente = [];

      if (!me.editedItem.tipo)
        this.errorMostrarMsjCliente.push(
          "El nombre del cliente no puede estar vacío"
        );

      if (this.errorMostrarMsjCliente.length) this.errorCliente = 1;

      return this.errorCliente;
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
      this.errorMostrarMsjCliente = [];

      this.selectAceiteModel = [];
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

        if (this.validarCliente()) {
          return;
        }
        this.actualizarCliente();
      } else {
        // this.desserts.push(this.editedItem);
        if (this.validarCliente()) {
          return;
        }
        this.registrarCliente();
      }
      this.close();
    },
  },
};
</script>
<style scoped>
.myboton {
  border-radius: 50px 0px !important;
  width: 155px !important;
  background: #0e738d !important;
}
</style>