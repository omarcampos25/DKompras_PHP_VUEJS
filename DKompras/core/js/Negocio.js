new Vue({
    el: '#negocio',
    vuetify: new Vuetify(),
    data: {
        nombreNegocio: "",
        email: "",
        items: [],
        direccion: "",
        ciudad: "",
        estado: "",
        telefono:"",
        licencia: "",
        ctr: "http://localhost/Dkompras_php_vuejs/Dkompras/core/php/Controlador_Negocio.php",
        item: {
            image: null,
            imageUrl: null
        },
        imageBase64: null,
        error: null,
        itemsDescuentos: [],
    },
    mounted() {

        let parametros = new URLSearchParams();
        parametros.append("accion", 1);
    
        axios.post(this.ctr, parametros)
          .then(function (response) {
            console.log(response.data.ciudad);
            this.nombreNegocio=response.data.negocio;
            this.email=response.data.email;
            this.direccion=response.data.direccion;
            this.ciudad=response.data.ciudad;
            this.estado=response.data.estado;
            this.telefono=response.data.telefono;
            this.licencia=response.data.licencia;

    
          }.bind(this))
          .catch(function (error) {
    
            console.log(error);
          })
          .then(function () {
    
            this.overlay = false;
          }.bind(this));
    
    
      },
      methods: {
        RegistrarProductos() {
          this.error = null;
          if (this.imageBase64 && this.codigo && this.descripcion && this.select && this.precio && this.descuento && this.cantidad) {
            let parametros = new URLSearchParams();
    
            parametros.append("accion", 3);
            parametros.append("codigo", this.codigo);
            parametros.append("descripcion", this.descripcion);
            parametros.append("familia", this.select);
            parametros.append("precio", this.precio);
            parametros.append("descuento", this.descuento);
            parametros.append("foto", this.imageBase64);
            parametros.append("cantidad", this.cantidad);
    
            axios.post(this.ctr, parametros)
              .then(function (response) {
                alert(response.data);
    
              }.bind(this))
              .catch(function (error) {
                console.log(error);
              })
              .then(function () {
                this.overlay = false;
              }.bind(this));
          } else {
            this.error = "No puedes dejar campos vacios."
          }
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
            this.imageBase64 = dataURL;
          })
        }
    
      }

})