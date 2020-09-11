new Vue({
  el: '#sucursal',
  vuetify: vuetify,
  data: () => ({
    ctr: "http://localhost/Dkompras_php_vuejs/Dkompras/core/php/controlador_Sucursales.php",
    ctrEstadoCiudad: 'http://localhost/Dkompras_php_vuejs/Dkompras/core/php/Controlador_CiudadEstado.php',
    dialog: false,
    headers: [
      {
        text: 'Sucursal',
        align: 'start',
        sortable: false,
        value: 'sucursal',
      },
      { text: 'Direccion', value: 'direccion' },
      { text: 'Ciudad', value: 'ciudad', sortable: false },
      { text: 'Estado', value: 'estado', sortable: false },
      { text: 'Telefono', value: 'telefono', sortable: false },
      { text: 'Email', value: 'email', sortable: false },
      { text: 'Formas de pago y entrega', value: 'formas', sortable: false },
      { text: 'Acciones', value: 'actions', sortable: false },//Acciones de los registros editar y eliminar
    ],
    sucursales: [],
    editedIndex: -1,
    editedItem: {
      idSucursal: '',
      sucursal: '',
      direccion: '',
      ciudad: '',
      estado: '',
      telefono: '',
      email: '',
    },
    defaultItem: {
      idSucursal: '',
      sucursal: '',
      direccion: '',
      ciudad: '',
      estado: '',
      telefono: '',
      email: '',
    },
    validador: false,
    dialogoPagos: false,
    dialogoEntregas: false,
    selectPagos: [],
    itemsPagos: [],
    selectEntregas: [],
    itemsEntregas: [],
    selectEstado: [],
    itemsEstados: [],
    selectCiudad: [],
    itemsCiudades: [],
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? 'Nueva sucursal' : 'Editar sucursal'
    },
  },

  watch: {
    dialog(val) {
      val || this.close()
    },
  },

  created() {
    this.initialize()
  },

  methods: {
    initialize() {
      this.ConsultarEstados();
      this.MostrarEntregasXNegocio();
      this.MostrarPagosXNegocio();
      let parametros = new URLSearchParams();
      parametros.append("accion", 1);

      axios.post(this.ctr, parametros)
        .then(function (response) {

          this.sucursales = response.data;

        }.bind(this))
        .catch(function (error) {

          console.log(error);
        })
        .then(function () {

          this.overlay = false;
        }.bind(this));
    },

    editItem(item) {
      //validador sirve para diferenciar si se esta editando o insertando
      this.validador = true;

      this.editItem.sucursal = item.sucursal;
      this.editItem.direccion = item.direccion;
      this.editItem.ciudad = item.ciudad;
      this.editItem.estado = item.estado;
      this.editItem.telefono = item.telefono;
      this.editItem.email = item.email;
      this.dialog = true
    },

    deleteItem(item) {
      
       const index = this.sucursales.indexOf(item)
       var validador = confirm('¿Estás seguro de eliminar este producto?') && this.sucursales.splice(index, 1)
 
       if (validador) 
       {
        
         let parametros = new URLSearchParams();
         parametros.append("accion", 5);
         parametros.append("sucursal", item.idSucursal);
 
         axios.post(this.ctr, parametros)
           .then(function (response) {
             console.log(response.data);
 
           }.bind(this))
           .catch(function (error) {
 
             console.log(error);
           })
           .then(function () {
 
             this.overlay = false;
           }.bind(this));
       }

    },

    close() {
      this.dialog = false
      this.dialogoEntregas = false
      this.dialogoPagos = false
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem)
        this.editedIndex = -1
      })
    },

    save() {
      if (this.validador) {
        this.EnviarDatosSucursal(7);
      } else {
        this.EnviarDatosSucursal(4);
      }
    },
    EnviarDatosSucursal(accion) {
      if (this.editedIndex > -1) {
        Object.assign(this.familias[this.editedIndex], this.editedItem)
      } else {
        let parametros = new URLSearchParams();

        parametros.append("accion", accion);
        parametros.append("sucursal", this.editedItem.sucursal);
        parametros.append("direccion", this.editedItem.direccion);
        parametros.append("ciudad", this.selectCiudad.ciudad);
        parametros.append("estado", this.selectEstado.estado);
        parametros.append("telefono", this.editedItem.telefono);
        parametros.append("email", this.editedItem.email);

        let idsPagos=[];
        let idsEntregas=[];
        
        this.selectPagos.forEach(element=>{
          
          idsPagos.push(element.idFormaPago)

        })

        this.selectEntregas.forEach(element=>{
          
          idsEntregas.push(element.idFormaEntrega)

        })

        parametros.append("formasPagos", JSON.stringify(this.selectPagos));
        parametros.append("formasEntregas", JSON.stringify(this.selectEntregas));
        
        axios.post(this.ctr,parametros)
          .then(function (response) {
            console.log(response.data);
          }.bind(this))
          .catch(function (error) {

            console.log(error);
          })
          .then(function () {

            this.overlay = false;
          }.bind(this));
      }
      this.close()
    },
    MostrarPagosXSucursal(item) {
      this.LimpiarCombos();

      let parametros = new URLSearchParams();
      this.dialogoPagos = true;
      parametros.append("accion", 2);

      axios.post(this.ctr, parametros)
        .then(function (response) {
          //Recorremos el arreglo 
          response.data.forEach(element => {
            //se compraran los ids
            if (element.sucursal == item.idSucursal) {
              //si el campo sucursal es igual a la sucursal seleccionada se mete al select y al body
              this.selectPagos.push(element);
              this.itemsPagos.push(element);
            } else {
              //si no solo se mete al body
              this.itemsPagos.push(element);
            }

          })

        }.bind(this))
        .catch(function (error) {

          console.log(error);
        })
        .then(function () {

          this.overlay = false;
        }.bind(this));
    },
    MostrarPagosXNegocio() {
      this.LimpiarCombos();

      let parametros = new URLSearchParams();
      parametros.append("accion", 2);

      axios.post(this.ctr, parametros)
        .then(function (response) {

          response.data.forEach(element => {

            this.itemsPagos.push(element);

          })

        }.bind(this))
        .catch(function (error) {

          console.log(error);
        })
        .then(function () {

          this.overlay = false;
        }.bind(this));
    },
    MostrarEntregasXSucursal(item) {
      this.LimpiarCombos();

      let parametros = new URLSearchParams();
      this.dialogoEntregas = true;
      parametros.append("accion", 3);

      axios.post(this.ctr, parametros)
        .then(function (response) {
          //Recorremos el arreglo 
          
          response.data.forEach(element => {
            //se compraran los ids

            if (element.sucursal == item.idSucursal) {
              //si el campo sucursal es igual a la sucursal seleccionada se mete al select y al body
              this.selectEntregas.push(element);
              this.itemsEntregas.push(element);
            } else {
              //si no solo se mete al body
              this.itemsEntregas.push(element);
            }

          })

        }.bind(this))
        .catch(function (error) {

          console.log(error);
        })
        .then(function () {

          this.overlay = false;
        }.bind(this));
    },
    MostrarEntregasXNegocio() {
      this.LimpiarCombos();

      let parametros = new URLSearchParams();
      parametros.append("accion", 3);

      axios.post(this.ctr, parametros)
        .then(function (response) {

          response.data.forEach(element => {

            this.itemsEntregas.push(element);

          })

        }.bind(this))
        .catch(function (error) {

          console.log(error);
        })
        .then(function () {

          this.overlay = false;
        }.bind(this));
    },
    LimpiarCombos() {
      this.selectPagos = [];
      this.selectEntregas = [];
      this.selectCiudad = [];
      this.selectEstado = [];

      this.itemsPagos = [];
      this.itemsEntregas = [];
      this.itemsEstados = [];
      this.itemsCiudades = [];
    },
    ConsultarEstados() {
      this.LimpiarCombos();

      let parametros = new URLSearchParams();
      parametros.append("accion", 1);

      axios.post(this.ctrEstadoCiudad, parametros)
        .then(function (response) {

          response.data.forEach(element => {

            this.itemsEstados.push(element);

          })

        }.bind(this))
        .catch(function (error) {

          console.log(error);
        })
        .then(function () {

          this.overlay = false;
        }.bind(this));
    },
    ConsultarCiudades() {


      let parametros = new URLSearchParams();
      parametros.append("accion", 2);
      parametros.append("idEstado", this.selectEstado.id);
      

      axios.post(this.ctrEstadoCiudad, parametros)
        .then(function (response) {
          
          response.data.forEach(element => {

            this.itemsCiudades.push(element);

          })

        }.bind(this))
        .catch(function (error) {

          console.log(error);
        })
        .then(function () {

          this.overlay = false;
        }.bind(this));
    }

  },
})

