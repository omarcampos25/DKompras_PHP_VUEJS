new Vue({
    el: '#entrega',
    vuetify: vuetify,
    data: () => ({
      ctr: sessionStorage.getItem('ruta')+"Dkompras/core/php/Controlador_FormaEntrega.php",
      dialog: false,
      headers: [
        {
          text: 'Forma de entrega',
          align: 'start',
          sortable: false,
          value: 'formaentrega',
        },
        { text: 'Costo', value: 'costo' },
        { text: 'Descripcion', value: 'descripcion' },
        { text: 'Actions', value: 'actions', sortable: false },//Acciones de los registros editar y eliminar
    ],
      formaEntrega: [],
      editedIndex: -1,
      editedItem: {
        idFormaEntrega:'',
        formaentrega: '',
        costo: '',
        descripcion:'',
      },
      defaultItem: {
        idFormaEntrega:'',
        formaentrega: '',
        costo: '',
        descripcion:'',
      },
      validador: false,
    }),
  
    computed: {
      formTitle() {
        return this.editedIndex === -1 ? 'Nueva forma de entrega' : 'Editar forma de entrega'
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
  
            this.formaEntrega = response.data;
  
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
        console.log(item.idFormaEntrega);
        this.editedItem.idFormaEntrega=item.idFormaEntrega;
        this.editedItem.formaentrega=item.formaentrega;
        this.editedItem.costo=item.costo;
        this.editedItem.descripcion=item.descripcion;
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
          this.EnviarDatos(7);
        } else {
          this.EnviarDatos(5);
        }
      },
      EnviarDatos(accion) {
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
  
    },
  })
  
  