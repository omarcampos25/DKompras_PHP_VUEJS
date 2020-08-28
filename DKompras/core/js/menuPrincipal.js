
const vuetify=new Vuetify()

new Vue({
     el:"#menu",
     vuetify:vuetify,
     data:{
         
         ctr:"../php/login.php"
     },
    props: {
      source: String,
    },
    data: () => ({
      drawer: null,
    }),
    methods: {
        ViewEmpresa(){
          window.location.href = 'http://localhost/Dkompras/vista/MenuEmpresa/Menu_empresa.php';
           /* e = document.createElement("article");
            e.innerHTML =" ";
            document.getElementById("contenedor").innerHTML="";
            document.getElementById("contenedor").appendChild(e);*/
        }
    },
  })
