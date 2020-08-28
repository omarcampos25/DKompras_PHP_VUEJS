
var time= new Date();

new Vue({
    el: '#pro',
    vuetify:vuetify,
    data: {
      ctr:"http://localhost/Dkompras/core/php/controlador_Producto.php",
        headers: [
            {
              text: 'Producto',
              align: 'start',
              sortable: false,
              value: 'productos',
            },
            { text: 'Familia', value: 'Familia' },
            { text: 'Descripción', value: 'Descripcion' },
            { text: 'Precio', value: 'precio' },
          ],
          productos: [],
    },
    mounted(){
      let parametros = new URLSearchParams();
      parametros.append("accion",2);
      //Peticion ajax al controlador y envio de parametros
      axios.post(this.ctr, parametros)
        .then(function (response) {
          this.productos=response.data;

        }.bind(this))
        .catch(function (error) {
          console.log(error);
        })
        .then(function () {
          this.overlay = false;


        }.bind(this));
    },
    created(){
       
    },
    methods:{
    
        },
        theme:{
          primary:'#ee44aa',
          secondary:'#424242',
          accent:'#82B1FF',
          error:'#FF5252',
          info:'#2196F3',
          succes:'#4CAF50',
          warning:'$FFC107'
        },
        customProperties: true,
        iconfont:'md',
  })



