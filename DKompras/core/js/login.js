
const vuetify=new Vuetify()

var firebaseConfig = {
  apiKey: "AIzaSyDjsWnhrR-rUpE653rZR4wrGzRgE2PiIY0",
  authDomain: "dekompras-f526a.firebaseapp.com",
  databaseURL: "https://dekompras-f526a.firebaseio.com",
  projectId: "dekompras-f526a",
  storageBucket: "dekompras-f526a.appspot.com",
  messagingSenderId: "974529990438",
  appId: "1:974529990438:web:1f34afe5bcdee2eb0d3be7",
  measurementId: "G-754D073ZFK"
};

//http://localhost/backendDKompras/
var firebase;
// Initialize Firebase
firebase.initializeApp(firebaseConfig);
firebase.analytics();
var time= new Date();

new Vue({
    el: '#login',
    vuetify:vuetify,
    data: {
      user:"",
      pass:"",
      email:"",
      password:"",
      error:"",
      nombre:"",
      aPaterno:"",
      aMaterno:"",
      passwordConfi:"",
      Empresa:"",
      FechaHora:"",
      Status:"false",
      form:1,
      mensaje:"",
      show1: false,
      show2: true,
      show3: false,
      show4: false,
      password: 'Password',
      rules: {
        required: value => !!value || 'Required.',
        min: v => v.length >= 4 || 'Min 8 characters',
        emailMatch: () => ('The email and password you entered don\'t match'),
      },
      
    },
    mounted(){
   
    },
    created(){
       
    },
    methods:{
      register(){
        let fechaActual=time.getDate()+'-'+(time.getMonth()+1)+'-'+time.getFullYear()+' '+time.getHours()+':'+time.getMinutes()+':'+time.getSeconds();
        if(this.email && this.password && this.aPaterno && this.aMaterno && this.nombre ){
          if(this.password==this.passwordConfi){
            firebase.auth().createUserWithEmailAndPassword(this.email, this.password)
            .then(user=>{
              console.log(user)
            }).catch(err=>{
              this.error=err.message
            }),
            firebase.database().ref('Usuarios').push({
              Correo:this.email,
              Empresa:this.Empresa,
              FechaHora:fechaActual,
              Nombre:this.nombre,
              Status:this.Status
            }).then(data=>{
              console.log(data);
            });
            this.form=1;
          }else{
            this.error="La contraseña no coincide"
          }
        }else{
          this.error="Todos los campos son requeridos"
        }
      },
      changeView(){
      this.form=0;  
      },
      login(){
        this.error=''
        if(this.user && this.pass){
          firebase.auth().signInWithEmailAndPassword(this.user,this.pass).
          then(user=>{
            console.log(user.user.uid);
            
         //   this.$cookie.set("uidUser", user.user.uid, "expiring time")
            window.location.href = 'http://localhost/DKOMPRAS_PHP_VUEJS/Dkompras/vista/MenuPrincipal/Menu_principal.php';
          }).catch(error=>{
            this.error=error;
          })
        }else{
          this.error='Todos los campos son requeridos'
        }
      },
      changeForgotPass(){
        this.form=2;
      },
      forgotMyPassword(){
        firebase.auth().sendPasswordResetEmail(this.user).then(function() {
        //alert("asd");
        
        }).catch(function(error) {    
         this.error=error;
         alert(error);
         alert(error);
        }).then(function(){
          
         // this.mensaje="";
          alert("Se ha enviado un correo a tu direccion de correo electrónico para restablecer la contraseña");
        });
       this.form=1;
      }

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



