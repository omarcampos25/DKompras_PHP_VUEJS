new Vue({
  el: '#familia',
  vuetify: vuetify,
  data: () => ({
    ctr: sessionStorage.getItem('ruta') +"Dkompras/core/php/controlador_Producto.php",
    dialog: false,
    headers: [
      {
        text: 'Familia',
        align: 'start',
        sortable: false,
        value: 'familia',
      },
      { text: 'Imagen', value: 'foto' },
      { text: 'Actions', value: 'actions', sortable: false },//Acciones de los registros editar y eliminar
    ],
    familias: [],
    editedIndex: -1,
    editedItem: {
      familia: '',
      foto: '',
      idFamilia: '',
    },
    defaultItem: {
      familia: '',
      foto: '',
    },
    item: {
      image: null,
      imageUrl: null
    },
    validador: false,
    imagenValidador: false,
    load:false,
    mensajeDialogo:'',
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? 'Nueva familia' : 'Editar familia'
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
      parametros.append("accion", 4);

      axios.post(this.ctr, parametros)
        .then(function (response) {
          
          this.familias = response.data;
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
      this.editedItem.familia = item.familia;
      this.editedItem.foto = item.foto;
      this.editedItem.idFamilia = item.idFamilia;
      this.dialog = true
    },

    deleteItem(item) {

      const index = this.familias.indexOf(item)
      var validador = confirm('¿Estás seguro de eliminar esta familia?') && this.familias.splice(index, 1)

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
        Object.assign(this.familias[this.editedIndex], this.editedItem)
      } else {
        let parametros = new URLSearchParams();

        if (this.imagenValidador) {
          this.editedItem.foto = imageBase64.replace("data:image/jpeg;base64,", "");
        }

        if (this.validador) {
          parametros.append("idFamilia", this.editedItem.idFamilia);
          console.log(this.editedItem.idFamilia);
        } else {
          this.familias.push(this.editedItem);
        }

        parametros.append("accion", accion);
        parametros.append("familia", this.editedItem.familia);
        parametros.append("foto", this.editedItem.foto);


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

