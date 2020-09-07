new Vue({
    el: '#pago',
    vuetify: vuetify,
    data: () => ({
      ctr: "http://localhost/Dkompras_php_vuejs/Dkompras/core/php/Controlador_Formapago.php",
      dialog: false,
      headers: [
        {
          text: 'Forma de pago',
          align: 'start',
          sortable: false,
          value: 'formapago',
        },
        { text: 'Comision', value: 'comision' },
        { text: 'Actions', value: 'actions', sortable: false },//Acciones de los registros editar y eliminar
    ],
      formaPago: [],
      editedIndex: -1,
      editedItem: {
        idFormaPago:'',
        formapago: '',
        comision: '',
      },
      defaultItem: {
        idFormaPago:'',
        formapago: '',
        comision: '',
      },
      validador: false,
    }),
  
    computed: {
      formTitle() {
        return this.editedIndex === -1 ? 'Nueva forma de pago' : 'Editar forma de pago'
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
  
            this.formaPago = response.data;
  
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

        this.editItem.idFormaPago=item.idFormaPago;
        this.editItem.formapago=item.formapago;
        this.editItem.comision=item.comision;
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
  
  