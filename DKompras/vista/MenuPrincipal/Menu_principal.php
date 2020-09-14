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
    <div id="menu">

        <template>
            <v-app id="inspire">
                <v-navigation-drawer v-model="drawer" app>
                    


                    <v-list dense>
                        <v-list-item link @click="ViewEmpresa()">
                            <v-list-item-action>
                                <v-icon></v-icon>
                            </v-list-item-action>
                            <v-list-item-content>
                                <v-list-item-title></v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>

                        <v-list-item link>
                            <v-list-item-action>
                                <v-icon>mdi-account</v-icon>
                            </v-list-item-action>
                            <v-list-item-content>
                                <v-list-item-title>Cerrar sesion</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                        <v-divider></v-divider>
                        <v-list-item link @click="ViewEmpresa()">
                            <v-list-item-action>
                                <v-icon>mdi-wrench</v-icon>
                            </v-list-item-action>
                            <v-list-item-content>
                                <v-list-item-title>Panel de control</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </v-list>


                </v-navigation-drawer>

                <v-app-bar app color="indigo"   dark  >
                    <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
                    <v-icon>mdi-cart </v-icon>
                    <v-toolbar-title>DKompras </v-toolbar-title>
                    <v-text-field class="mx-4" flat hide-details label="Search"
                         solo-inverted></v-text-field>
                </v-app-bar>

                <v-main>
                    <v-container class="fill-height" fluid>
                        <v-row align="center" justify="center">
                            <v-col class="text-center">
                                <v-tooltip left>
                                    <template v-slot:activator="{ on }">

                                        <section id="contenedor">
                                            <v-row>
                                                <v-col cols="12" sm="12">
                                                    <v-carousel cycle height="400" hide-delimiter-background
                                                        show-arrows-on-hover>
                                                        <v-carousel-item v-for="(slide, i) in slides" :key="i">
                                                            <v-sheet :color="colors[i]" height="100%">
                                                                <v-row class="fill-height" align="center"
                                                                    justify="center">
                                                                    <div class="display-3">{{ slide }} </div>
                                                                </v-row>
                                                            </v-sheet>
                                                        </v-carousel-item>
                                                    </v-carousel>
                                                </v-col>
                                            </v-row>
                                            Productos con descuentos
                                            <v-divider inset></v-divider>
                                            <v-row>



                                                <v-col cols="12" sm="3" v-for="(item,i) in items">
                                                    <v-card elevation="24" max-width="100%" class="mx-auto">
                                                        <v-system-bar lights-out></v-system-bar>
                                                        <v-carousel :continuous="false" :cycle="cycle"
                                                            :show-arrows="true" hide-delimiter-background
                                                            delimiter-icon="mdi-minus" height="300">
                                                            <v-carousel-item v-for="(item,i) in items" :key="i"
                                                                :src="item.src" reverse-transition="fade-transition"
                                                                transition="fade-transition">
                                                            </v-carousel-item>
                                                        </v-carousel>
                                                        <v-list two-line>
                                                            <v-list-item>
                                                                $1,500
                                                                <v-list-item-content>
                                                                    <v-list-item-title>Ardilla</v-list-item-title>
                                                                    <v-list-item-subtitle>+Kotas</v-list-item-subtitle>
                                                                </v-list-item-content>
                                                                <v-list-item-action>
                                                                    <v-btn small color="primary">Comprar</v-btn>
                                                                </v-list-item-action>
                                                            </v-list-item>
                                                        </v-list>
                                                    </v-card>
                                                </v-col>

                                            </v-row>




                                        </section>

                                    </template>

                                </v-tooltip>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-main>
                <v-footer color="indigo" app>
                    <span class="white--text">Sistemas en secuencia SA DE CV &copy;{{new Date().getFullYear() }}</span>
                </v-footer>
            </v-app>
        </template>

    </div>


</body>
<script src="../../core/js/menuPrincipal.js"></script>
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