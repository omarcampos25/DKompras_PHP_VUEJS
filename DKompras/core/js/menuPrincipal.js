
const vuetify = new Vuetify()

new Vue({
  el: "#menu",
  vuetify: vuetify,
  props: {
    source: String,
  },
  data: () => ({
    drawer: null,
    ctr: sessionStorage.getItem('ruta') + "Dkompras/core/php/login.php",
    items: [
      {
        src: 'https://cdn.vuetifyjs.com/images/carousel/squirrel.jpg',
      },
      {
        src: 'https://cdn.vuetifyjs.com/images/carousel/sky.jpg',
      },
      {
        src: 'https://cdn.vuetifyjs.com/images/carousel/bird.jpg',
      },
      {
        src: 'https://cdn.vuetifyjs.com/images/carousel/planet.jpg',
      },
    ],
    colors: [
      'green',
      'secondary',
      'yellow darken-4',
      'red lighten-2',
      'orange darken-1',
    ],
    cycle: false,
    slides: [
      'Promocion 1',
      'Promocion 2',
      'Promocion 3',
      'Promocion 4',
      'Promocion 5',
    ],
    buscador:'',
  }),
  created() {

    this.initialize();
    
  },
  methods: {
    initialize(){
      this.VistaPrincipal();
    },
    MostrarVistaBusqueda(){
      localStorage.setItem('codigo', this.buscador);
     
      
      let parametros = new URLSearchParams();
      parametros.append("accion", 1);
      parametros.append("url", sessionStorage.getItem('ruta') + 'Dkompras/vista/MenuPrincipal/Productos_Consultados.php');
      
      axios.post(this.ctr, parametros)
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
    VistaPrincipal() {
      let parametros = new URLSearchParams();
      parametros.append("accion", 1);
      parametros.append("url", sessionStorage.getItem('ruta') + 'Dkompras/vista/MenuPrincipal/Busqueda_producto.php');
      
      axios.post(this.ctr, parametros)
        .then(function (response) {

          e = document.createElement("article");
          e.innerHTML = response.data;
          document.getElementById("contenedor").innerHTML = "";
          document.getElementById("contenedor").appendChild(e);

          var nuevo_script = document.createElement("script");
          nuevo_script.src = document.getElementById("busqueda").dataset.script;
          e.appendChild(nuevo_script);

        }.bind(this))
        .catch(function (error) {
          console.log(error);
        })
        .then(function () {
          this.overlay = false;


        }.bind(this));
    },
    ViewEmpresa() {
      window.location.href = sessionStorage.getItem('ruta') + 'Dkompras/vista/MenuEmpresa/Menu_empresa.php';
      /* e = document.createElement("article");
       e.innerHTML =" ";
       document.getElementById("contenedor").innerHTML="";
       document.getElementById("contenedor").appendChild(e);*/
    }
  },
})
