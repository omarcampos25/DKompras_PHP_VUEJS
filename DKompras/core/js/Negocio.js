new Vue({
  el: '#negocio',
  vuetify: new Vuetify(),
  data: {
    imagen:"",
    nombreNegocio: "",
    mensaje:"",
    email: "",
    items: [],
    direccion: "",
    ciudad: "",
    estado: "",
    telefono: "",
    licencia: "",
    ctr: "http://localhost/Dkompras_php_vuejs/Dkompras/core/php/Controlador_Negocio.php",
    item: {
      image: null,
      imageUrl: null
    },
    imageBase64: "",
    error: null
  },
  mounted() {
    this.LLenarDatos();

  },
  methods: {
    LLenarDatos() {

      let parametros = new URLSearchParams();
      parametros.append("accion", 1);

      axios.post(this.ctr, parametros)
        .then(function (response) {
          console.log(response.data);

          response.data.forEach(element => {
            console.log(element.telefono);
            this.nombreNegocio = element.negocio;
            this.email = element.email;
            this.direccion = element.direccion;
            this.ciudad = element.ciudad;
            this.estado = element.estado;
            this.telefono = element.telefono;
            this.licencia = element.licencia;
            this.imagen="data:image/jpeg;base64,"+element.logo;
          })

        }.bind(this))
        .catch(function (error) {

          console.log(error);
        })
        .then(function () {

          this.overlay = false;
        }.bind(this));

    },
    onChangePreView(e) {
      const file = e.target.files[0]
      console.log(file);
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
        this.imagen = dataURL;
       
      }.bind(this))
    },
    ActualizarDatos() {
      let parametros = new URLSearchParams();
      parametros.append("logo", this.imagen.replace("data:image/jpeg;base64,", ""));
      parametros.append("accion", 2);
      parametros.append("nombreNegocio", this.nombreNegocio);
      parametros.append("correoNegocio", this.email);
      parametros.append("direccionNegocio",this.direccion);
      parametros.append("ciudadNegocio",this.ciudad);
      parametros.append("estadoNegocio",this.estado);
      parametros.append("telefonoNegocio",this.telefono);
  
      axios.post(this.ctr, parametros)
        .then(response=>{
          this.mensaje="Datos modificados";
        })
        .catch(function (error) {

          console.log(error);
        })
        .then(function () {

          this.overlay = false;
        }.bind(this));
    }

  }

})