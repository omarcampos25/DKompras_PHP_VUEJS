
const vuetify = new Vuetify();
new Vue({
    el: '#detalle',
    vuetify: vuetify,
    data: () => ({
        buscador: '',
        producto: [],
        ctr: sessionStorage.getItem('ruta') +"Dkompras/core/php/Controlador_DetalleProducto.php",
        nombreProducto:'',
        imagenProducto:'',
        logoEmpresa:'',
        nombreEmpresa:'',
        descripcionProducto:'',
        imagenes:[],
        dialog:''
    }),
    created() {
        this.MostrarDetalles();
        this.MostrarImagenes();
      },
    methods: {

        MostrarDetalles() {

            let parametro = new URLSearchParams();
            parametro.append('accion', 1);
            parametro.append('idProducto', localStorage.getItem('idProducto'));
            axios.post(this.ctr, parametro).
            then(function (response) {
              console.log(response.data);
              response.data.forEach(element=>{
                console.log(element.codigo);
                this.nombreProducto=element.codigo;
                this.imagenProducto=element.imagen;
                this.logoEmpresa=element.logo;
                this.nombreEmpresa=element.Negocio;
                this.descripcionProducto=element.descripcion;
              })
              }.bind(this))
              .catch(function (error) {
      
                console.log(error);
              })
              .then(function () {
      
                
              }.bind(this));

        },
        MostrarImagenes() {

          let parametro = new URLSearchParams();
          parametro.append('accion', 2);
          parametro.append('idProducto', localStorage.getItem('idProducto'));
          axios.post(this.ctr, parametro).
          then(function (response) {
            console.log(response.data);
            this.imagenes=response.data;
            
            }.bind(this))
            .catch(function (error) {
    
              console.log(error);
            })
            .then(function () {
    
              
            }.bind(this));

      },
      MostrarCarrucel(){
        
        this.dialog=true;
      },
      close(){
        this.dialog=false;
      }
    }

})