<template>
  <main class="main">
    <h1>Cliente</h1>
    {{perfilModel}}
    {{vue.exp}}
    {{select}}
    {{estacionesModal}}
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
                          v-model="editedItem.name"
                          label="Nombre"
                        ></v-text-field>
                      </v-col>

                      <v-col cols="12" sm="12" md="12">
                        <v-text-field
                          v-model="editedItem.email"
                          label="Correo"
                        ></v-text-field>
                      </v-col>

                      <v-col cols="12" sm="12" md="12">
                        <v-text-field
                          :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                          :rules="[rules.required, rules.min]"
                          :type="show1 ? 'text' : 'password'"
                          v-model="editedItem.password"
                          label="Passwor"
                          @click:append="show1 = !show1"
                        ></v-text-field>
                      </v-col>

                      <v-col cols="12" sm="12" md="12">
                        <v-select
                          :items="arrayPerfil"
                          v-model="perfilModel"
                          single-line
                          item-text="perfil"
                          item-value="id"
                          return-object
                          :menu-props="{ top: true, offsetY: true }"
                          persistent-hint
                          placeholder="Selecciona.."
                          v-on:change="datosPerfil(`${perfilModel.id}`)"
                        ></v-select>
                      </v-col>

                      <v-col v-if="vue.exp ==2" cols="12" sm="12" md="12">
                        <v-select
                         :items="arrayCategoria"
                          v-model="select"
                          single-line
                          item-text="compania"
                          item-value="id"
                          return-object
                          
                          v-on:change="changeRoute(`${select.id}`)"
                          placeholder="Selecciona.."
                        ></v-select>
                      </v-col>
                      <!-- persistent-hint selectCategoria -->
                      <v-col v-if="vue.exp ==2" cols="12" sm="12" md="12">
                        <v-select
                          :items="arrayEstaciones"
                          v-model="estacionesModal"
                          :menu-props="{ top: true, offsetY: true }"
                          item-text="estacion"
                          item-value="estacion.id"
                          return-object
                          attach
                          chips
                          label="Estaciones"
                          multiple
                          persistent-hint
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

          <template v-if="item.condicion == 1">
            <v-icon
              color="red lighten-2"
              small
              @click="desactivarCliente(item.id)"
            >
              mdi-delete
            </v-icon>
          </template>
          <template v-else>
            <v-icon
              color="blue lighten-2"
              small
              @click="activarCliente(item.id)"
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
      vue: {
        exp: null
      },
      show1: false,
      dialog: false,
      dialogDelete: false,
      search: "",
      rules: {
        required: value => !!value || 'Required.',
        min: v => v.length >= 8 || 'Min 8 characters',
        emailMatch: () => (`The email and password you entered don't match`),
      },

      select: {},
      arrayCategoria: [],


      perfilModel: { },
      arrayPerfil: [{perfil: "Administrador", id: '1'},{perfil: "Cliente", id: '2'}],
      // value6: ["1", "2"],
      estacionesModal: [],
      arrayEstaciones: [],
      // value2: ["foo", "bar", "fizz", "buzz"],


      headers: [
        { text: "Opciones", value: "opciones", sortable: false },
        { text: "Nombre", align: "start", value: "name" },
        { text: "Email", align: "start", value: "email" },
        // { text: "Perfil2", align: "start", value: "usuarioTipo" },
        { text: "Perfil", align: "start", value: "usuarioTiposimple" },
        // { text: "Cliente", align: "start", value: "cliente" },
        { text: "Cliente Simple", align: "start", value: "clientesimple" },
        // { text: "Estaciones", align: "start", value: "estaciones" },
        { text: "Estaciones Simple", align: "start", value: "estacionessimple" },
        { text: "Condicion", value: "condicion", sortable: false },
      ],
      desserts: [],
      editedIndex: -1,
      editedItem: {
        id: 0,
        name: "",
        email: "",
        usuarioTipo: "",
        password: "",
        cliente: "",
        estaciones: "",
      },
      defaultItem: {
        name: "",
        email: "",
        usuarioTipo: "",
        password: "",
        cliente: "",
        estaciones: "",
      },
      errorCliente: 0,
      errorMostrarMsjCliente: [],
      tipoAccion: 0,
    };
  },

  computed: {
    formTitle() {
      return this.editedIndex === -1
        ? "Registrar Cliente"
        : "Actualizar Cliente";
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
    this.selectCategoria();
  },

  methods: {
    initialize() {
      // history.pushState(null, "", "Cliente");
      let me = this;
      axios
        .get("/user")
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
    selectCategoria(){
        let me = this;
      axios
        .get("/cliente/selectCliente")
        .then(function (response) {
          // handle success
        //  console.log(response.data.cliente);
        me.arrayCategoria = response.data.cliente;

         console.log(me.arrayCategoria);

        })
        .catch(function (error) {
          // handle error
          console.log(error);
        });
    },
    datosPerfil(a){

      this.vue.exp = a;

      let perfil = a;
      if( 1 == perfil){
        this.estacionesModal = [];
        this.select = {};
      }
      console.log(a)
    },
    changeRoute(a){
      // this.estacionesModal = [];
      // alert(a);
       let me = this;
       let id = a; 
       let url= '/estacion/selectEstacionId?id=' + id;

       me.estacionesModal = [];
      axios
        .get(url)
        .then(function (response) {
          // handle success
        //  console.log(response.data.cliente);
        me.arrayEstaciones = response.data.estaciones;

         console.log(me.arrayEstaciones);

        })
        .catch(function (error) {
          // handle error
          console.log(error);
        });
    },
    desactivarCliente(id) {
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: "btn btn-success",
          cancelButton: "btn btn-danger",
        },
        buttonsStyling: false,
      });

      swalWithBootstrapButtons
        .fire({
          title: "Esta seguro de desactivar esté Usuario?",
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
              .put("/user/desactivar", {
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
    activarCliente(id) {
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: "btn btn-success",
          cancelButton: "btn btn-danger",
        },
        buttonsStyling: false,
      });

      swalWithBootstrapButtons
        .fire({
          title: "Esta seguro de activar esté Usuario?",
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
              .put("/user/activar", {
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

      console.log(JSON.parse(item.usuarioTipo))
      // alert(JSON.stringify(item));
      let perfil = JSON.stringify(item.usuarioTipo);
      // alert(perfil)
      let perfilEval = JSON.stringify("{\"perfil\":\"Administrador\",\"id\":\"1\"}");
       if( perfilEval == perfil){
         this.vue.exp = 1;
       }else{
         this.vue.exp = 2;
       }
      // this.vue.exp = 2;
      this.editedIndex = this.desserts.indexOf(item);
      this.editedItem = Object.assign({}, item);

      let dato1 = JSON.parse(item.usuarioTipo);
      let dato2 = JSON.parse(item.cliente);
      let dato3 = JSON.parse(item.estaciones);

      // alert(dato2.id)
      this.changeRoute(dato2.id);
      this.perfilModel =  dato1;
      this.select = dato2;
      this.estacionesModal = dato3;
      //  console.log(this.editedIndex);
      this.dialog = true;
    },
    registrarCliente() {
      // if (this.validarCliente()) {
      //   return;
      // }
      let me = this;

      let name = me.editedItem.name;
      let email = me.editedItem.email;
      let password = me.editedItem.password;
      let usuarioTipo = JSON.stringify(me.perfilModel);
      let cliente = JSON.stringify(me.select);
      let estaciones = JSON.stringify(me.estacionesModal);

      let estacionSimple = JSON.parse(estaciones);
      let arrayEstacion = [];
      Object.entries(estacionSimple).forEach(([key, value]) => {
        console.log(value.estacion)
        arrayEstacion.push(' '+value.estacion);
      });
      // console.log( arrayEstacion.toString() );
      let estacionSim = arrayEstacion.toString();

      console.log(name);
      console.log(email);
      console.log(password);
      console.log(usuarioTipo);
      console.log(cliente);
      console.log(estaciones);

      axios
        .post("/user/registrar", {
          // compania: me.editedItem.compania,

          name: name,
          email: email,
          // usuarioTipo: "",
          password: password,
          usuarioTipo: usuarioTipo,
          cliente: cliente,
          estaciones: estaciones,
          estacionessimple: estacionSim,
          
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

      let name = me.editedItem.name;
      let email = me.editedItem.email;
      let password = me.editedItem.password;
      let usuarioTipo = JSON.stringify(me.perfilModel);
      let cliente = JSON.stringify(me.select);
      let estaciones = JSON.stringify(me.estacionesModal);

      let estacionSimple = JSON.parse(estaciones);
      let arrayEstacion = [];
      Object.entries(estacionSimple).forEach(([key, value]) => {
        console.log(value.estacion)
        arrayEstacion.push(' '+value.estacion);
      });
      // console.log( arrayEstacion.toString() );
      let estacionSim = arrayEstacion.toString();
      
      axios
        .put("/user/actualizar", {
          id: me.editedItem.id,
          name: name,
          email: email,
          // usuarioTipo: "",
          password: password,
          usuarioTipo: usuarioTipo,
          cliente: cliente,
          estaciones: estaciones,
          estacionessimple: estacionSim,
          // id: '2',
          // name: 'Jorge 333',
          // email: 'jorgev3_@hotmail.com',
          // usuarioTipo: "",
          // password: '11111111',
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

      if (!me.editedItem.name)
        this.errorMostrarMsjCliente.push(
          "El nombre del Usuario no puede estar vacío"
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

      this.estacionesModal = [];
      this.perfilModel = [];
      this.select = [];

      this.vue.exp = 1;
      this.editedItem.email = [];
      this.editedItem.password = [];
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