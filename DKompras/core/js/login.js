
const vuetify = new Vuetify()

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
var time = new Date();

new Vue({
  el: '#login',
  vuetify: vuetify,
  data: {
    user: "",
    pass: "",
    email: "",
    password: "",
    empresa: "",
    error: "",
    nombre: "",
    aPaterno: "",
    aMaterno: "",
    passwordConfi: "",
    show1: "",
    Empresa: 0,
    FechaHora: "",
    fire: false,
    Status: "false",
    form: 1,
    mensaje: "",
    ctr: "http://localhost/Dkompras_php_vuejs/Dkompras/core/php/login.php",
    uid: "",
    nombreEmpresa: "",
    correoEmpresa: "",
    direccionEmpresa: "",
    ciudadEmpresa: "",
    telefonoEmpresa: "",
    estadoEmpresa: "",
    password: 'Password',
    rules: {
      required: value => !!value || 'Required.',
      min: v => v.length >= 4 || 'Min 8 characters',
      emailMatch: () => ('The email and password you entered don\'t match'),
    },

  },
  mounted() {

  },
  created() {

  },
  methods: {
    register() {

      if (this.email && this.password && this.aPaterno && this.aMaterno && this.nombre) {
        if (this.password == this.passwordConfi) {
          firebase.auth().createUserWithEmailAndPassword(this.email, this.password)
            .then(user => {

              this.RegistarDatos(user.user.uid);

            }).catch(err => {
              this.error = err.message
            })
          this.form = 1;
        } else {
          this.error = "La contraseña no coincide"
        }
      } else {
        this.error = "Todos los campos son requeridos"
      }
    },
    RegistarDatos(uid) {
      let fechaActual = time.getDate() + '-' + (time.getMonth() + 1) + '-' + time.getFullYear() + ' ' + time.getHours() + ':' + time.getMinutes() + ':' + time.getSeconds();
      firebase.database().ref("Usuarios/" + uid + '/').set({
        Correo: this.email,
        Empresa: this.Empresa,
        FechaHora: fechaActual,
        Nombre: this.nombre,
        Status: this.Status
      }).then(data => {
        this.RegistrarUsuarioDB(uid);
      });
    },
    changeView() {
      this.form = 0;
    },
    login() {
      this.error = ''
      if (this.user && this.pass) {
        firebase.auth().signInWithEmailAndPassword(this.user, this.pass).
          then(user => {
            this.uid = user.user.uid;
            this.VerificarEmpresa(user.user.uid);
            //   this.$cookie.set("uidUser", user.user.uid, "expiring time")
            //    window.location.href = 'http://localhost/DKOMPRAS_PHP_VUEJS/Dkompras/vista/MenuPrincipal/Menu_principal.php';
          }).catch(error => {
            this.error = error;
          })
      } else {
        this.error = 'Todos los campos son requeridos'
      }
    },
    changeForgotPass() {
      this.form = 2;
    },
    forgotMyPassword() {
      firebase.auth().sendPasswordResetEmail(this.user).then(function () {
        //alert("asd");

      }).catch(function (error) {
        this.error = error;
        alert(error);
        alert(error);
      }).then(function () {

        // this.mensaje="";
        alert("Se ha enviado un correo a tu direccion de correo electrónico para restablecer la contraseña");
      });
      this.form = 1;
    },
    VerificarEmpresa(uid) {

      var ruta = '/Usuarios/' + uid + '/Empresa';

      firebase.database().ref(ruta).once('value').then(snapshot => {
        this.empresa = snapshot.val();
        if (this.empresa == 0) {
          this.form = 4;
        } else {
          let parametros = new URLSearchParams();
          parametros.append("accion", 3);
          parametros.append("uid", this.uid);

          axios.post(this.ctr, parametros)
            .then(function (response) {
              console.log(response.data);


                window.location.href = 'http://localhost/DKOMPRAS_PHP_VUEJS/Dkompras/vista/MenuPrincipal/Menu_principal.php';




              console.log(response);
            }.bind(this))
            .catch(function (error) {
              console.log(error);
            })
            .then(function () {

              this.overlay = false;
            }.bind(this));

        }
      });

    },
    RegistrarEmpresa() {
      let licencia = time.getDate() + '-' + (time.getMonth() + 2) + '-' + time.getFullYear() + ' ' + time.getHours() + ':' + time.getMinutes() + ':' + time.getSeconds();
      let parametros = new URLSearchParams();
      parametros.append("accion", 2);
      parametros.append("nombreEmpresa", this.nombreEmpresa);
      parametros.append("emailEmpresa", this.correoEmpresa);
      parametros.append("direccionEmpresa", this.direccionEmpresa);
      parametros.append("ciudadEmpresa", this.ciudadEmpresa);
      parametros.append("estadoEmpresa", this.estadoEmpresa);
      parametros.append("telefonoEmpresa", this.telefonoEmpresa);
      parametros.append("licencia", licencia);
      parametros.append("uid", this.uid);

      axios.post(this.ctr, parametros)
        .then(function (response) {
          window.location.href = 'http://localhost/DKOMPRAS_PHP_VUEJS/Dkompras/vista/MenuPrincipal/Menu_principal.php';
          console.log(response);
        }.bind(this))
        .catch(function (error) {

          console.log(error);
        })
        .then(function () {

          this.overlay = false;
        }.bind(this));
    },
    RegistrarUsuarioDB(uid) {
      let parametros = new URLSearchParams();
      parametros.append("accion", 3);
      parametros.append("email", this.email);
      parametros.append("nombre", this.nombre);
      parametros.append("uid", uid);

      axios.post(this.ctr, parametros)
        .then(function (response) {

          this.familias = response.data;

        }.bind(this))
        .catch(function (error) {

          console.log(error);
        })
        .then(function () {

          this.overlay = false;
        }.bind(this));

    }


  },
  theme: {
    primary: '#ee44aa',
    secondary: '#424242',
    accent: '#82B1FF',
    error: '#FF5252',
    info: '#2196F3',
    succes: '#4CAF50',
    warning: '$FFC107'
  },
  customProperties: true,
  iconfont: 'md',
})



