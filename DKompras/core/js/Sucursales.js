new Vue({
    el: '#sucursal',
    vuetify: vuetify,
    data: () => ({
      ctr: "http://localhost/Dkompras_php_vuejs/Dkompras/core/php/controlador_Sucursales.php",
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
        idSucursal:'',
        sucursal: '',
        direccion: '',
        ciudad: '',
        estado:'',
        telefono:'',
        email:'',
      },
      defaultItem: {
        idSucursal:'',
        sucursal: '',
        direccion: '',
        ciudad: '',
        estado:'',
        telefono:'',
        email:'',
      },
      validador: false,
      dialogoPagos:false,
      dialogoEntregas:false,
      selectPagos: [],
        itemsPagos: [],
        selectEntregas: ['Recoger en Sucursal', 'Fedex'],
        itemsEntregas: [
          'estafeta',
          'DHL',
          'Avion',
          'Uber',
        ],
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

        this.editItem.sucursal=item.sucursal;
        this.editItem.direccion=item.direccion;
        this.editItem.ciudad=item.ciudad;
        this.editItem.estado=item.estado;
        this.editItem.telefono=item.telefono;
        this.editItem.email=item.email;
        this.dialog = true
      },
  
      deleteItem(item) {
       /*
        const index = this.familias.indexOf(item)
        var validador = confirm('¿Estás seguro de eliminar este producto?') && this.familias.splice(index, 1)
  
        if (validador) 
        {
          console.log(item.idFamilia);
          let parametros = new URLSearchParams();
          parametros.append("accion", 6);
          parametros.append("idFamilia", item.idFamilia);
  
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
        }*/
  
      },
  
      close() {
        this.dialog = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },
  
      save() {
        if (this.validador) {
          this.EnviarDatosFamilia(7);
        } else {
          this.EnviarDatosFamilia(5);
        }
      },
      EnviarDatosFamilia(accion) {
        if (this.editedIndex > -1) {
          Object.assign(this.familias[this.editedIndex], this.editedItem)
        } else {
          let parametros = new URLSearchParams();
  
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
        this.close()
      },
      ShowPagos(item){
        let parametros = new URLSearchParams();
        console.log(item.idSucursal);
        this.dialogoPagos=true;

        parametros.append("accion", 2);
        axios.post(this.ctr, parametros)
          .then(function (response) {
           this.itemsPagos=response.data;
  
          }.bind(this))
          .catch(function (error) {
  
            console.log(error);
          })
          .then(function () {
  
            this.overlay = false;
          }.bind(this));
      },
      ShowEntregas(item){
        console.log(item.idSucursal);
        this.dialogoEntregas=true;

        parametros.append("accion", 2);
        axios.post(this.ctr, parametros)
          .then(function (response) {
            console.log(response.data);
           this.itemsPagos=response.data;
  
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
  
  