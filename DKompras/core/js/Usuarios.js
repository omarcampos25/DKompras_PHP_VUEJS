new Vue({
    el: '#user',
    vuetify: vuetify,
    data: () => ({
      ctr: "http://localhost/Dkompras/core/php/controlador_Producto.php",
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
      item: {
        image: null,
        imageUrl: null
      },
      validador: false,
      imagenValidador: false
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
        let parametros = new URLSearchParams();
        parametros.append("accion", 4);
  
        axios.post(this.ctr, parametros)
          .then(function (response) {
  
            this.usuarios = response.data;
  
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
        this.dialog = true
      },
  
      deleteItem(item) {
  
        const index = this.usuarios.indexOf(item)
        var validador = confirm('¿Estás seguro de eliminar este usuario?') && this.usuarios.splice(index, 1)
  
        if (validador) 
        {
          console.log(item.id);
          let parametros = new URLSearchParams();
          parametros.append("accion", 6);
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
          this.EnviarDatosFamilia(7);
        } else {
          this.EnviarDatosFamilia(5);
        }
      },
      EnviarDatosFamilia(accion) {
        if (this.editedIndex > -1) {
          Object.assign(this.usuarios[this.editedIndex], this.editedItem)
        } else {
          let parametros = new URLSearchParams();
  
      
          if (this.validador) {
            parametros.append("idFamilia", this.editedItem.idFamilia);
            console.log(this.editedItem.idFamilia);
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
      onChangePreView(e) {
        this.imagenValidador = true;
        const file = e.target.files[0]
        this.image = file
        this.item.imageUrl = URL.createObjectURL(file)
        this.ConvertImageToBase64();
      },
      toDataURL(src, callback) {
        var image = new Image();
        image.crossOrigin = 'Anonymous';
  
        image.onload = function () {
          var canvas = document.createElement('canvas');
          var context = canvas.getContext('2d');
          canvas.height = this.naturalHeight,
            canvas.width = this.naturalWidth;
          context.drawImage(this, 0, 0);
          var dataURL = canvas.toDataURL('image/jpeg');
          callback(dataURL);
        };
        image.src = src;
      },
      ConvertImageToBase64() {
        this.toDataURL(this.item.imageUrl, function (dataURL) {
          this.imageBase64 = dataURL;
          console.log(typeof (imageBase64));
        })
      },
  
  
    },
  })
  
  