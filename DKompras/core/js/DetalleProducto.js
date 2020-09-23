
const vuetify=new Vuetify();
new Vue({
    el:'#detalle',
    vuetify:vuetify,
    data:()=>({
        buscador:'',
        producto:[],
    }),
    mounted(){
    
    },
    MostarDetalles(){
        let parametro=new URLSearchParams();
        parametro.append('accion',1);
        parametro.append('idProducto',localStorage.getItem('idProducto'));
        axios.post(this.ctr,parametros)
        .then(response=>{

        })
        .catch(error=>{

        })
        .then(response=>{
           
        })

    }


})