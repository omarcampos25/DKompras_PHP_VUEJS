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
        <v-app id="inspire">
            <v-app-bar app color="indigo" dark>
                <v-icon>mdi-cart </v-icon>
                <v-toolbar-title>DKompras </v-toolbar-title>
                <v-text-field class="mx-16" flat hide-details label="Search" @keyup.enter.native="" v-model='buscador'
                    solo-inverted></v-text-field>
            </v-app-bar>



            <v-card elevation='24' class=' mt-16 mx-16' width="93%">
                <v-container>

                    <v-row justify="space-between">
                    
                        <v-col cols="1" sx="1" md="1">

                            <v-row v-for="item in imagenes">
                                <v-img :src="'data:image/jpeg;base64,'+item.ruta" aspect-ratio="1"
                                    class="grey lighten-2" max-width="200" @click="MostrarCarrucel" max-height="100">
                            </v-row>

                        </v-col>  
                        <v-col cols="5" sx="5" md="5">
                            <v-img height="300" width="100%" :src="'data:image/jpeg;base64,'+imagenProducto"
                                @click="MostrarCarrucel"></v-img>
                        </v-col>

                        <v-col cols="6" sx="12" md="6" class="text-${h1}, active && mb-${4}">
                            <v-list-item-title class="font-weight-black font-weight-regular lg-h6" >
                            {{nombreProducto}}
                            </v-list-item-title>
                            <v-list-item-subtitle>{{descripcionProducto}}</v-list-item-subtitle>
                            <v-col>
                                <v-btn icon>
                                    <v-btn class="mx-2" fab dark small color="pink">
                                        <v-icon dark>mdi-heart</v-icon>
                                    </v-btn>
                                </v-btn>
                            </v-col>
                            
                            <v-btn 
              x-large color="indigo"  dark>Comprar</v-btn>
                                    
                                
                        </v-col>
                        
                    </v-row>
                    
                    <v-row>

                        <v-textarea  disabled outlined name="input-7-4" label="Descripcion"
                            
                            v-model="descripcionProducto"
                            >
                        </v-textarea>
                    </v-row>
                </v-container>
            </v-card>
            <v-dialog v-model="dialog" max-width="40%">

                <v-card>
                    <v-card-title>
                        <span class="headline"></span>
                    </v-card-title>

                    <v-card-text>
                        <v-container>
                            <v-row>
                                <v-carousel>
                                    <v-carousel-item v-for="(item,i) in imagenes" :key="i"
                                        :src="'data:image/jpeg;base64,'+item.ruta" reverse-transition="fade-transition"
                                        height="300" max-width="100%" transition="fade-transition">
                                    </v-carousel-item>
                                </v-carousel>
                            </v-row>
                        </v-container>
                    </v-card-text>

                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="blue darken-1" text @click="close">OK</v-btn>

                    </v-card-actions>
                </v-card>
            </v-dialog>

            <v-footer color="indigo" app>
                <span class="white--text">Sistemas en secuencia SA DE CV &copy;{{new Date().getFullYear() }}</span>
            </v-footer>
        </v-app>

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