const vuetify = new Vuetify()

new Vue({
  el: "#menuEmpresa",
  vuetify: vuetify,
  props: {
    source: String,
  },
  data: () => ({
    titulo: "",
    drawer: null,
    ctr: sessionStorage.getItem('ruta')+"Dkompras/core/php/login.php",
    OpcionProductos:"0",
    admins: [
      ['Lista de productos','1',sessionStorage.getItem('ruta')+'Dkompras/vista/productos/Catalogo_productos.php','pro'],
      ['Familias','1',sessionStorage.getItem('ruta')+'Dkompras/vista/productos/ModuloFamilias.php','familia'],
    ],
    cruds: [
      ['Ajustes'],
      ['Existencias'],
    ],
    configuraciones:[
      ['Usuarios','1',sessionStorage.getItem('ruta')+'Dkompras/vista/Configuraciones/Usuarios.php','user'],
      ['Negocio','1',sessionStorage.getItem('ruta')+'Dkompras/vista/Configuraciones/Negocio.php','negocio'],
      ['Sucursales','1',sessionStorage.getItem('ruta')+'Dkompras/vista/Configuraciones/Sucursales.php','sucursal'],
      ['Formas de pago','1',sessionStorage.getItem('ruta')+'Dkompras/vista/Configuraciones/Formas_pago.php','pago'],
      ['Formas de entrega','1',sessionStorage.getItem('ruta')+'Dkompras/vista/Configuraciones/Formas_entrega.php','entrega'],
    ],
  }),
  methods: {
    ViewHome() {
      this.titulo = "Nuevo producto";
      window.location.href = sessionStorage.getItem('ruta')+'Dkompras/vista/MenuPrincipal/Menu_principal.php';
    },
    optionProducto(){
      if(this.OpcionProductos=="0"){
        this.OpcionProductos="1";
      }else{
        this.OpcionProductos="0";
      }
     
    },
    VistasMenu(accion,modulo,url,script){
      this.titulo = modulo;
      let parametros = new URLSearchParams();
      parametros.append("accion",accion);
      parametros.append("url",url);
      //Peticion ajax al controlador y envio de parametros
      //Traer catalogo productos
      axios.post(this.ctr, parametros)
        .then(function (response) {

          e = document.createElement("article");
          e.innerHTML = response.data;
          document.getElementById("contenedor").innerHTML = "";
          document.getElementById("contenedor").appendChild(e);

          var nuevo_script = document.createElement("script");
          nuevo_script.src = document.getElementById(script).dataset.script;
          e.appendChild(nuevo_script);

        }.bind(this))
        .catch(function (error) {
          console.log(error);
        })
        .then(function () {
          this.overlay = false;


        }.bind(this));
    }
  },
})
