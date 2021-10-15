<template>
  <main class="main">
    <h1>Aceite</h1>
     <!-- <ol class="breadcrumb">
      <li class="breadcrumb-item">Aceite</li>
    </ol> -->
    {{select}}
    <select id="origen">

    </select>
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
            
            <v-spacer>

            </v-spacer>

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
                        <v-select
                         :items="arrayTipAce"
                         v-model="select"
                          single-line
                          item-text="name"
                          item-value="id"
                          return-object
                          persistent-hint selectCategoria
                          v-on:change="changeRoute(`${select.id}`)"
                          placeholder="Selecciona.."
                        ></v-select>

                        <v-text-field
                          v-model="editedItem.marca"
                          label="Marca"
                        ></v-text-field>

                        <v-text-field
                          v-model="editedItem.modelo"
                          label="Modelo"
                        ></v-text-field>
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
      select: { },
      arrayTipAce: [
            { id: "Lubricacion", name: "Lubricacion" },
            { id: "Hidraulico", name: "Hidraulico" },
            { id: "Termico", name: "Termico" },
            { id: "Dielectrico", name: "Dielectrico" },
      ],
    // arrayTipAce: [
    //         "Lubricacion" ,
    //         "Hidraulico" ,
    //        "Termico" ,
    //         "Dielectrico" ,
    //   ],
      headers: [
        { text: "Opciones", value: "opciones", sortable: false },
        { text: "Tipo de Aceite", align: "start", value: "tipoAceite" },
        { text: "Marca", align: "start", value: "marca" },
        { text: "Modelo", align: "start", value: "modelo" },
        
      ],
      desserts: [],
      editedIndex: -1,
      editedItem: {
        id: 0,
        tipoAceite: "",
        marca: "",
        modelo: "",
       
      },
      defaultItem: {
        tipoAceite: "",
        marca: "",
        modelo: "",
        
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
    // this.idioma();
    // this.fetchPokemonData();
  },

  methods: {
    fetchPokemonData(){
    //let url = pokemon.url // <--- this is saving the pokemon url to a      variable to us in a fetch.(Ex: https://pokeapi.co/api/v2/pokemon/1/)

        axios
        // .get("https://pokeapi.co/api/v2/pokemon/1/")
        //.get("https://venta.odm.com.mx/netScripts/Request.aspx?APPNAME=Navegante&PRGNAME=CreaSesion&ARGUMENTS=-A1")
        // .get("https://venta.odm.com.mx/netScripts/Request.aspx?APPNAME=Navegante&PRGNAME=RecuperaCorridasVRARGUMENTS&ARGUMENTS=-AMEX,-AGDL,-A15/07/2021,-A1,-A0,-A0,-A0,-A0,-AV1,-A,-A,-A,-A,-A,-A,-A,-A,-A,-A1,-A27871352,-A1")
        .get("https://venta.odm.com.mx/netScripts/Request.aspx?APPNAME=Navegante&PRGNAME=OrigenDestino")
        //.get("https://venta.odm.com.mx/netScripts/Request.aspx?APPNAME=Navegante&PRGNAME=OrigenDestino&ARGUMENTS=-AGDL")
        .then(function (response) {
            // handle success
            // console.log(response.data.moves);
            // var str1 = "(example)";
            const div = document.querySelector("#origen");
            
            let move = response.data;
            //  let str2 = move.replace('( )',"")
            //let formJson = JSON.parse(str2);

            //  let datos = JSON.stringify(response.data);

            //  var texto = 'texto sin parentesis, texto con (parentesis), otro texto con (parentesis)';
            // ---let x = move.replace(/[()]/g, '');

            // ---- let cadenaCorregida = x.slice(0, -6) + ']';
            //  const obj = JSON.parse(x);
            //var textoSinParentesis = datos.replace(/\((\w+)\)/g, "$1");
             div.innerHTML = move; 
             let arrayJson = [];
             let list = {'Origen' :[]};

             let sel = document.getElementById('origen');

              for (var i = 0; i < sel.children.length; ++i) {
                  var child = sel.children[i];
                  if (child.tagName == 'OPTION'){
                     let valorOp = child.value;
                     let textOp = child.text;

                     let obj = {
                                  valor: valorOp,
                                  texto: textOp
                                  }

                    list.Origen.push({
                                  "valor": valorOp,
                                  "texto": textOp,
                                });
                      // arrayJson.push(obj);
                  } 
              }
              // list = JSON.stringify(list);
              // list = JSON.parse(list);
              // JSON.stringify
            console.log(list.Origen);
           
        })
        .catch(function (error) {
          // handle error
          console.log(error);
        });
    },
    // idioma(){
       
    //     setTimeout(function() { 
    //         let texto = document.getElementsByClassName("v-data-footer__select")[0].childNodes[0].nodeValue = 'Filas por página';

    //         let texto2 = document.getElementsByClassName("v-data-footer__pagination")[0].childNodes[0].nodeValue;

    //         var divisiones = texto2.split(' ');
    //         let dato1 = divisiones[0];
    //         let dato2 = divisiones[2];

    //         let cadena = dato1 + ' '+ 'de'+' '+dato2;
    //         console.log(texto);
    //         // console.log(cadena);
    //         document.getElementsByClassName("v-data-footer__pagination")[0].childNodes[0].nodeValue = cadena;
    //     }, 1000);

        
    // },
    changeRoute(a) {
        //this.$router.push({path: a })
        console.log(a)
    },
    initialize() {
      // history.pushState(null, "", "Aceite");
      let me = this;
      axios
        .get("/aceite")
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
    editItem(item) {
      this.editedIndex = this.desserts.indexOf(item);
      this.editedItem = Object.assign({}, item);

      let tipoAceite = this.editedItem.tipoAceite;

      this.select =  {id: tipoAceite, name:tipoAceite};

        console.log('prueba' + tipoAceite);
      this.dialog = true;
    },
    registrarCliente() {
      if (this.validarCliente()) {
        return;
      }
      let me = this;

      axios
        .post("/aceite/registrar", {
          tipoAceite: me.select.name,
          marca: me.editedItem.marca,
          modelo: me.editedItem.modelo
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
        .put("/aceite/actualizar", {
          // compania: me.editedItem.estacion,
          // id: me.editedItem.id,

          id: me.editedItem.id,
          tipoAceite: me.select.name,
          marca: me.editedItem.marca,
          modelo: me.editedItem.modelo

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

    //   if (!me.editedItem.tipoAceite)
    //     this.errorMostrarMsjCliente.push(
    //       "El nombre del cliente no puede estar vacío"
    //     );

      if (!me.select.name)
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
  .myboton{
    border-radius: 50px 0px !important;
    width: 155px!important;
    background: #0e738d !important;
  }
  #origen{
    display: none;
  }
</style>