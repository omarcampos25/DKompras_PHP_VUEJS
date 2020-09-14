
const vuetify=new Vuetify()

new Vue({
     el:"#menu",
     vuetify:vuetify,
     data:{
         ctr:"../php/login.php",
        
         
     },
    props: {
      source: String,
    },
    data: () => ({
      drawer: null,
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
    }),
    methods: {
        ViewEmpresa(){
          window.location.href = sessionStorage.getItem('ruta')+'Dkompras/vista/MenuEmpresa/Menu_empresa.php';
           /* e = document.createElement("article");
            e.innerHTML =" ";
            document.getElementById("contenedor").innerHTML="";
            document.getElementById("contenedor").appendChild(e);*/
        }
    },
  })
