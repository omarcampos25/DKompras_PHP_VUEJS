
var time = new Date();

new Vue({
  el: '#pro',
  vuetify: vuetify,
  data: () => ({
    ctr: "http://localhost/Dkompras_php_vuejs/Dkompras/core/php/controlador_Producto.php",
    dialog: false,
    headers: [
      {
        text: 'Producto',
        align: 'start',
        sortable: false,
        value: 'productos',
      },
      { text: 'descripcion', value: 'Descripcion' },
      { text: 'cantidad', value: 'Cantidad' },
      { text: 'precio', value: 'Precio' },
      { text: ' descuento', value: 'Descuento' },
      { text: 'familia', value: 'Familia' },
      { text: 'Imagen', value: 'foto' },
      { text: 'Actions', value: 'actions', sortable: false },
    ],
    productos: [],
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
    dialog:'',
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? 'Nuevo producto' : 'Editar producto'
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
      parametros.append("accion", 2);

      axios.post(this.ctr, parametros)
        .then(function (response) {

          this.productos = response.data;

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
      this.editedItem.producto = item.producto;
      this.editedItem.descripcion = item.descripcion;
      this.editedItem.cantidad = item.cantidad;
      this.editedItem.precio = item.precio;
      this.editedItem.descuento = item.descuento;
      this.editedItem.familia = item.familia;
      this.editedItem.foto = item.foto;

      this.dialog = true
    },

    deleteItem(item) {

      const index = this.familias.indexOf(item)
      var validador = confirm('¿Estás seguro de eliminar este producto?') && this.familias.splice(index, 1)

      if (validador) {
        console.log(item.idProducto);
        let parametros = new URLSearchParams();
        parametros.append("accion", 6);
        parametros.append("idProducto", item.idProducto);

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

        if (this.imagenValidador) {
          this.editedItem.foto = imageBase64.replace("data:image/jpeg;base64,", "");
        }

        if (this.validador) {
          parametros.append("idProducto", this.editedItem.idFamilia);
          console.log(this.editedItem.idFamilia);
        } else {
          this.familias.push(this.editedItem);
        }

        parametros.append("accion", accion);
        parametros.append("producto", editedItem.producto);
        parametros.append("descripcion", editedItem.descripcion);
        parametros.append("cantidad", editedItem.cantidad);
        parametros.append("precio", editedItem.precio);
        parametros.append("descuento", editedItem.descuento);
        parametros.append("familia", editedItem.familia);
        parametros.append("foto", editedItem.foto);




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


