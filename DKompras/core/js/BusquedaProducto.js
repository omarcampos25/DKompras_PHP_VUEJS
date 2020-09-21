new Vue({
    el: '#busqueda',
    vuetify: vuetify,
    data: () => ({

        ctr: sessionStorage.getItem('ruta')+"Dkompras/core/php/Controlador_Busqueda.php",
        item: {
            image: null,
            imageUrl: null
        },
        imageBase64: null,
        error: null,
        itemsDescuentos: [],
        drawer: null,
        items: [],
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
        model: null,



    }),
    mounted() {

        this.MostrarContenidoPrincipal();

    },
    methods: {

        MostrarContenidoPrincipal(){
            
            let parametros = new URLSearchParams();
            parametros.append("accion", 1);
           
            axios.post(this.ctr, parametros)
              .then(function (response) {
                console.log(response.data);

              
                    this.items=(response.data);
                
    
              }.bind(this))
              .catch(function (error) {
    
                console.log(error);
              })
              .then(function () {
    
                this.overlay = false;
              }.bind(this));
          }
        }


    
})