new Vue({
  el: '#user',
  vuetify: vuetify,
  data: () => ({
    ctr: sessionStorage.getItem('ruta')+"Dkompras/core/php/Controlador_Configuracion.php",
    dialog: false,
    headers: [
      {
        text: 'Nombre',
        align: 'start',
        sortable: false,
        value: 'nombre',
      },
      { text: 'Email', value: 'email' },
      { text: 'Actions', value: 'actions', sortable: false },//Acciones de los registros editar y eliminar
    ],
    usuarios: [],
    editedIndex: -1,
    editedItem: {
      nombre: '',
      email: '',
      id: '',
    },
    defaultItem: {
      nombre: '',
      email: '',
    },
    validador: false,
    imagenValidador: false,
    dialog:false,
    mensajeDialogo:false,
  }),
  computed: {
    formTitle() {
      return this.editedIndex === -1 ? 'Nueva usuario' : 'Editar usuario'
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
      this.load=true;
      this.mensajeDialogo='Cargando datos...';
      let parametros = new URLSearchParams();
      parametros.append("accion", 1);

      axios.post(this.ctr, parametros)
        .then(function (response) {

          this.usuarios = response.data;
          this.load=false;

        }.bind(this))
        .catch(function (error) {

          console.log(error);
        })
        .then(function () {

          this.overlay = false;
        }.bind(this));
    },

    editItem(item) {
      this.validador = true;
      this.editedItem.nombre = item.nombre;
      this.editedItem.email = item.email;
      this.editedItem.id = item.id;
      console.log(this.editedItem.id);
      console.log(item.id);
      this.dialog = true
    },

    deleteItem(item) {

      const index = this.usuarios.indexOf(item)
      var validador = confirm('¿Estás seguro de eliminar este usuario?') && this.usuarios.splice(index, 1)

      if (validador) 
      {
        console.log(item.id);
        let parametros = new URLSearchParams();
        parametros.append("accion", 3);
        parametros.append("id", item.id);

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
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem)
        this.editedIndex = -1
      })
    },

    save() {
      if (this.validador) {
        //Modificar usuario
        this.EnviarDatosUsuario(2);
      } else {
        //Insertar usuario
        this.EnviarDatosUsuario(4);
      }
    },
    EnviarDatosUsuario(accion) {
      if (this.editedIndex > -1) {
        Object.assign(this.usuarios[this.editedIndex], this.editedItem)
      } else {

        let parametros = new URLSearchParams();
        if (this.validador) {
          parametros.append("id", this.editedItem.id);
          console.log(this.editedItem.id);
        } else {
          this.usuarios.push(this.editedItem);
        }

        parametros.append("accion", accion);
        parametros.append("nombre", this.editedItem.nombre);
        parametros.append("email", this.editedItem.email);


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
