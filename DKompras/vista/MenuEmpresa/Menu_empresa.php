<!DOCTYPE html>
<html lang="en">
<head>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/vue-resource@1.3.5"></script>
    <script src="../../vuetify-v2.3.7.js"  ></script>
    <link rel="stylesheet" href="../../vuetify-v2.3.7.css">
    <!--FireBase-->
    <script src="https://www.gstatic.com/firebasejs/7.18.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.18.0/firebase-analytics.js"></script>
    <script src="https://unpkg.com/vue-router@2.0.0/dist/vue-router.js"></script>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <title>Menu Empresa</title>
 
</head>
<body>
<div id="menuEmpresa" >

    <template>
      <v-app id="inspire">
        <v-navigation-drawer
          v-model="drawer"
          app
        >
        
        <v-card
    class="mx-auto"
    width="700"
  >
    <v-list width="700" >
      <v-list-item>
        <v-list-item-icon>
          <v-icon>mdi-home</v-icon>
        </v-list-item-icon>

        <v-list-item-title>Home</v-list-item-title>
      </v-list-item>

      <v-list-group
        
        value="true"
      >
        <template v-slot:activator>
          <v-list-item-title>Opciones</v-list-item-title>
        </template>

        <v-list-group
          no-action
          sub-group
          value="true"
        >

              <template v-slot:activator>
                <v-list-item-content>
                  <v-list-item-title>Productos</v-list-item-title>
                </v-list-item-content>
              </template>

              <v-list-item
                v-for="(admin, i) in admins"
                :key="i"
                link
              >
                
             <v-list-item-title  v-text="admin[0]" @click="VistasMenu(admin[1],admin[0],admin[2],admin[3])" ></v-list-item-title> 
                      <v-list-item-icon >
                        <v-icon ></v-icon>
                        </v-list-item-icon>
                      </v-list-item>
          </v-list-group>
            

          <v-list-group
            sub-group
            no-action
          >
            <template v-slot:activator>
              <v-list-item-content>
                <v-list-item-title>Almacen</v-list-item-title>
              </v-list-item-content>
            </template>
            <v-list-item
              v-for="(crud, i) in cruds"
              :key="i"
              link
            >
              <v-list-item-title v-text="crud[0]" ></v-list-item-title>
              <v-list-item-action>
                <v-icon ></v-icon>
              </v-list-item-action>
            </v-list-item>
          </v-list-group>

          <v-list-group
          sub-group
          no-action
        >
          <template v-slot:activator>
            <v-list-item-content>
              <v-list-item-title>Configuraciones</v-list-item-title>
            </v-list-item-content>
          </template>
          <v-list-item
            v-for="(dates, i) in configuraciones"
            :key="i"
            link
          >
            <v-list-item-title v-text="dates[0]" @click="VistasMenu(dates[1],dates[0],dates[2],dates[3])" ></v-list-item-title>
            <v-list-item-action>
              <v-icon ></v-icon>
            </v-list-item-action>
          </v-list-item>
        </v-list-group>
      </v-list-group>

        </v-list-group>
    </v-list>
  </v-card>
        </v-navigation-drawer>

        <v-app-bar app color="indigo" dark >
          <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
          <v-toolbar-title>{{titulo}}</v-toolbar-title>
        </v-app-bar>

        <v-main>
          <v-container fluid >
            <section id="contenedor">
            </section>
          </v-container>
        </v-main>
        <v-footer
          color="indigo"
          app
        >
          <span class="white--text">Sistemas en secuencia SA DE CV &copy;{{new Date().getFullYear() }}</span>
        </v-footer>
      </v-app>
    </template>

</div>


</body>
<script src="../../core/js/menuEmpresa.js"></script>
<script type="module">
  export default {
    props: {
      source: String,
    },
    data: () => ({
      drawer: null,
    })
  }
</script>

</html>
