
const vuetify = new Vuetify();
new Vue({
    el: '#detalle',
    vuetify: vuetify,
    data: () => ({
        buscador: '',
        producto: [],
        ctr: sessionStorage.getItem('ruta') +"Dkompras/core/php/Controlador_DetalleProducto.php",
        ctrBusqueda: sessionStorage.getItem('ruta') + "Dkompras/core/php/login.php",
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
      MostrarVistaBusqueda(){
        localStorage.setItem('codigo', this.buscador);
       
        
        let parametros = new URLSearchParams();
        parametros.append("accion", 1);
        parametros.append("url", sessionStorage.getItem('ruta') + 'Dkompras/vista/MenuPrincipal/Productos_Consultados.php');
        
        axios.post(this.ctrBusqueda, parametros)
          .then(function (response) {
  
            e = document.createElement("article");
            e.innerHTML = response.data;
            document.getElementById("contenedor").innerHTML = "";
            document.getElementById("contenedor").appendChild(e);
  
            var nuevo_script = document.createElement("script");
            nuevo_script.src = document.getElementById("consulta").dataset.script;
            e.appendChild(nuevo_script);
  
          }.bind(this))
          .catch(function (error) {
            console.log(error);
          })
          .then(function () {
            this.overlay = false;
  
  
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