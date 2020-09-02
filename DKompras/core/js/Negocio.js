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
            console.log(response.data);

            response.data.forEach(element=>{
              console.log(element.telefono);
              this.nombreNegocio=element.negocio;
              this.email=element.email;
              this.direccion=element.direccion;
              this.ciudad=element.ciudad;
              this.estado=element.estado;
              this.telefono=element.telefono;
              this.licencia=element.licencia;
            })

          }.bind(this))
          .catch(function (error) {
    
            console.log(error);
          })
          .then(function () {
    
            this.overlay = false;
          }.bind(this));
    
    
      },
      methods: {
       
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