<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/vue-resource@1.3.5"></script>
    <script src="../../vuetify-v2.3.7.js"></script>
    <link rel="stylesheet" href="../../vuetify-v2.3.7.css">
    <!--FireBase-->
    <script src="https://www.gstatic.com/firebasejs/7.18.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.18.0/firebase-analytics.js"></script>
    <script src="https://unpkg.com/vue-router@2.0.0/dist/vue-router.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu principal</title>

</head>

<body>
    <div id="detalle">

        <template>
            <v-app id="inspire">

                <v-app-bar app color="indigo" dark>

                    <v-icon>mdi-cart </v-icon>
                    <v-toolbar-title>DKompras </v-toolbar-title>
                    <v-text-field class="mx-4" flat hide-details label="Search" @keyup.enter.native=""
                        v-model='buscador' solo-inverted></v-text-field>
                </v-app-bar>
                <v-parallax
    dark
    src="https://cdn.vuetifyjs.com/images/backgrounds/vbanner.jpg"
  >
  <v-main>
                    <v-container fluid>
                        <section id="contenedor" width="100%">
                            <v-card elevation='24'  class="d-inline-block mx-auto mt-12 mx-auto" width="100%" >
                                <v-container>
                                    <v-row justify="space-between">
                                        <v-col cols="auto">
                                            <v-img height="200" width="200"
                                                src="https://cdn.vuetifyjs.com/images/backgrounds/vbanner.jpg"></v-img>
                                        </v-col>

                                        <v-col cols="auto" class="text-center pl-0">
                                            <v-row class="flex-column ma-0 fill-height" justify="center">
                                                <v-col class="px-0">
                                                <v-list-item-title class="headline mb-1">Headline 5</v-list-item-title>
        <v-list-item-subtitle>Greyhound divisely hello coldly fonwderfully</v-list-item-subtitle>
     
                                                </v-col>

                                                <v-col class="px-0">
                                                    <v-btn icon>
                                                        <v-icon>mdi-bookmark</v-icon>
                                                    </v-btn>
                                                </v-col>

                                                <v-col class="px-0">
                                                    <v-btn icon>
                                                        <v-icon>mdi-share-variant</v-icon>
                                                    </v-btn>
                                                </v-col>
                                            </v-row>
                                        </v-col>
                                    </v-row>
                                </v-container>
                            </v-card>
                        </section>
                    </v-container>
                </v-main>
    <v-row
      align="center"
      justify="center"
    >
      <v-col class="text-center" cols="12">
        <h1 class="display-1 font-weight-thin mb-4">Vuetify.js</h1>
        <h4 class="subheading">Build your application today!</h4>
      </v-col>
    </v-row>
  </v-parallax>
               
                <v-footer color="indigo" app>
                    <span class="white--text">Sistemas en secuencia SA DE CV &copy;{{new Date().getFullYear() }}</span>
                </v-footer>
            </v-app>
        </template>

    </div>


</body>
<script src="../../core/js/DetalleProducto.js"></script>
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