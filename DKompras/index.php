<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="//cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/vue-resource@1.3.5"></script>
    <script src="vuetify-v2.3.7.js"  ></script>
    <link rel="stylesheet" href="vuetify-v2.3.7.css">
    <!--FireBase-->
    <script src="https://www.gstatic.com/firebasejs/7.18.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.18.0/firebase-analytics.js"></script>
    <script src="https://unpkg.com/vue-router@2.0.0/dist/vue-router.js"></script>
    
    
</head>
<body> 
    
<div id="login"> 

<v-app id="inspire" >

<v-card
    color=""
    height="100%"
    width="100%"
    
  >
    <v-toolbar dense>
      
      <v-toolbar-title> DKompras</v-toolbar-title>

      <v-spacer></v-spacer>

     

      <v-btn color="primary" @click="changeView()">Crear cuenta nueva</v-btn>

      
    </v-toolbar>
    <v-main v-show="form==4">
      <v-container
        class="fill-height"
        fluid
      >
        <v-row
          alingn="center"
          justify="center"
        >
          <v-col
            cols="12"
            sm="8"
            md="4"
          >
            <v-card class="elevation-12">
              <v-toolbar
                color="primary"
                dark
                flat
              >
                <v-toolbar-title>Registra tu empresa</v-toolbar-title>
                <v-spacer></v-spacer>
             
              </v-toolbar>
              <v-card-text>
                <v-form>
                 
                <v-text-field label="Nombre del negocio" v-model="nombreEmpresa" name="nombre" type="text"> </v-text-field>
                <v-text-field label="Correo electronico" v-model="correoEmpresa" name="aPaterno"  type="text"> </v-text-field>
                <v-text-field label="Direccion" v-model="direccionEmpresa"  type="text"> </v-text-field>
                
                <v-text-field label="Ciudad" v-model="ciudadEmpresa" name="login" type="text"> </v-text-field>
                <v-text-field v-model="estadoEmpresa" label="Estado"   > </v-text-field>
                <v-text-field v-model="telefonoEmpresa" label="Telefono"   > </v-text-field>
                
              </v-form>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>             
                <v-btn color="primary" @click="RegistrarEmpresa()">Registrar</v-btn>
              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-main>
    <v-main v-show="form==0">
      <v-container
        class="fill-height"
        fluid
      >
        <v-row
          alingn="center"
          justify="center"
        >
          <v-col
            cols="12"
            sm="8"
            md="4"
          >
            <v-card class="elevation-12">
              <v-toolbar
                color="primary"
                dark
                flat
              >
                <v-toolbar-title>Registrate</v-toolbar-title>
                <v-spacer></v-spacer>
             
              </v-toolbar>
              <v-card-text>
                <v-form>
                 
                <v-text-field label="Nombre" v-model="nombre" name="nombre" prepend-icon="mdi-account" type="text"> </v-text-field>
                <v-text-field label="Apellido paterno" v-model="aPaterno" name="aPaterno" prepend-icon="mdi-account" type="text"> </v-text-field>
                <v-text-field label="Apellido materno" v-model="aMaterno" name="aMaterno" prepend-icon="mdi-account" type="text"> </v-text-field>
                  
                <v-text-field label="Correo" v-model="email" name="login" prepend-icon="mdi-account" type="text"> </v-text-field>
                <v-text-field  id="password" v-model="password" label="Contraseña" name="password" prepend-icon="mdi-lock" type="password"> </v-text-field>
                <v-text-field  id="password" v-model="passwordConfi" label="Confirmar contraseña" name="password" prepend-icon="mdi-lock" type="password"> </v-text-field>
                
              </v-form>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>             
                <v-btn color="primary" @click="register()">Registrarse</v-btn>
              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-main>
    <v-main v-show="form==1">
      <v-container
        class="fill-height"
        fluid
      >
        <v-row
          alingn="center"
          justify="center"
        >
          <v-col
            cols="12"
            sm="8"
            md="4"
          >
            <v-card class="elevation-12">
              <v-toolbar
                color="primary"
                dark
                flat
              >
                <v-toolbar-title>Inicia Sesión</v-toolbar-title>
                <v-spacer></v-spacer>
             
              </v-toolbar>
              <v-card-text>
                <v-form>
                  
                <v-text-field label="Correo" v-model="user" name="login" prepend-icon="mdi-account" type="text"> </v-text-field>
                <v-text-field @click:append="show1 = !show1" id="password" v-model="pass" label="Contraseña" name="password" prepend-icon="mdi-lock" :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
            :rules="[rules.required, rules.min]"
            :type="show1 ? 'text' : 'password'" > </v-text-field>
               
              </v-form>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="primary"  @click="changeForgotPass()">Olvide mi contraseña</v-btn>
                <v-btn color="primary" @click="login()">Iniciar sesión</v-btn>
              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-main>
    <v-main v-show="form==2">
      <v-container
        class="fill-height"
        fluid
      >
        <v-row
          alingn="center"
          justify="center"
        >
          <v-col
            cols="12"
            sm="8"
            md="4"
          >
            <v-card class="elevation-12">
              <v-toolbar
                color="primary"
                dark
                flat
              >
                <v-toolbar-title>Restablecer contraseña</v-toolbar-title>
                <v-spacer></v-spacer>
             
              </v-toolbar>
              <v-card-text>
                <v-form>
                <v-icon left>mdi-twitter</v-icon>Ingresa tu correo </v-chip>
                
                <v-text-field label="Correo" v-model="user" name="login" prepend-icon="mdi-account" type="text"> </v-text-field>
               
              </v-form>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="primary" @click="forgotMyPassword()">Enviar correo</v-btn>
              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    
    </v-main>
    
    <v-alert type="error" v-if="error" dismissible>
      {{error}}
    </v-alert>
    <v-alert type="success" v-if="mensaje" dismissible >
      {{mensaje}}
    </v-alert>
   

 
  </v-card>
    
  </v-app>
     

</div>



<script src="https://www.gstatic.com/firebasejs/7.18.0/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.18.0/firebase-database.js"></script>
 
</body>

<script src="./core/js/login.js"></script>
</html>
