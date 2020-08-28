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
    ctr: "http://localhost/Dkompras_php_vuejs/Dkompras/core/php/login.php",
    OpcionProductos:"0",
    admins: [
      ['Nuevo producto','1','http://localhost/Dkompras_php_vuejs/Dkompras/vista/productos/Alta_productos.php','CatalogoEmpleados'],
      ['Lista de productos','1','http://localhost/Dkompras_php_vuejs/Dkompras/vista/productos/Catalogo_productos.php','pro'],
      ['Familias','1','http://localhost/Dkompras_php_vuejs/Dkompras/vista/productos/ModuloFamilias.php','familia'],
    ],
    cruds: [
      ['Ajustes'],
      ['Existencias'],
    ],
    configuraciones:[
      ['Usuarios','1','http://localhost/Dkompras_php_vuejs/Dkompras/vista/Configuraciones/Usuarios.php','user']

    ],
  }),
  methods: {
    ViewHome() {
      this.titulo = "Nuevo producto";
      window.location.href = 'http://localhost/Dkompras_php_vuejs/Dkompras_php_vuejs/Dkompras/vista/MenuPrincipal/Menu_principal.php';
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
