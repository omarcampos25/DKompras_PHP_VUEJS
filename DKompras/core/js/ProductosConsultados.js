new Vue({
  el: '#consulta',
  vuetify: vuetify,
  data: () => ({
    ctr: sessionStorage.getItem('ruta') + "Dkompras/core/php/Controlador_ProductosConsultados.php",
    items: [
      'primary',
      'secondary',
      'yellow darken-2',
      'red',
      'orange',
    ],
  }),
  mounted() {
    this.MostrarProductos();
  },
  methods: {

    MostrarProductos() {

      let parametros = new URLSearchParams();
      parametros.append("accion", 1);
      parametros.append("codigo", localStorage.getItem('codigo'));

      axios.post(this.ctr, parametros)
        .then(function (response) {
          this.items = (response.data);
        }.bind(this))
        .catch(function (error) {

          console.log(error);
        })
        .then(function () {

          
        }.bind(this));
    },
    MostrarDetalleProducto(idProducto) {
      alert(idProducto);
      localStorage.setItem('idProducto',idProducto);
      window.location.href = sessionStorage.getItem('ruta')+'Dkompras/vista/Compras/DetalleProducto.php';

    }
  }



})