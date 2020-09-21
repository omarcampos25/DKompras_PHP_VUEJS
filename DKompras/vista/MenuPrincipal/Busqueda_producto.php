<div id="busqueda" data-script="../../core/js/BusquedaProducto.js">
    <v-form>

        <v-row>
            <v-col cols="12" sm="12" md="12">
                <v-carousel cycle height="400" hide-delimiter-background show-arrows-on-hover>
                    <v-carousel-item v-for="(slide, i) in slides" :key="i">
                        <v-sheet :color="colors[i]" height="100%">
                            <v-row class="fill-height" align="center" justify="center">
                                <div class="display-3">{{ slide }} </div>
                            </v-row>
                        </v-sheet>
                    </v-carousel-item>
                </v-carousel>
            </v-col>
        </v-row>

        <v-divider inset></v-divider>
        <v-row>

            <v-sheet class="mx-auto" elevation="8" max-width="100%">
                <v-slide-group v-model="model" class="pa-4" mandatory show-arrows>
                    <v-slide-item v-for="(item,i) in items" :key="n" v-slot:default="{ active, toggle }">
                    <v-card elevation="24" class="ma-4" width="300" class="mx-auto">
                    <v-system-bar lights-out></v-system-bar>
                    <v-carousel :continuous="false" :cycle="cycle" :show-arrows="true" hide-delimiter-background
                        delimiter-icon="mdi-minus" height="300">
                        <v-carousel-item :alt="item.imagen" v-bind:src="'data:image/jpeg;base64,'+item.imagen"
                            reverse-transition="fade-transition" transition="fade-transition">
                        </v-carousel-item>
                    </v-carousel>
                    <v-list two-line>
                        <v-list-item>
                            <v-list-item-content>
                                <v-list-item-title> {{item.codigo}}</v-list-item-title>
                                <v-list-item-subtitle>{{item.precio}}</v-list-item-subtitle>
                            </v-list-item-content>
                            <v-list-item-action>
                                <v-btn small color="primary">Comprar</v-btn>
                            </v-list-item-action>
                        </v-list-item>
                    </v-list>
                </v-card>
                    </v-slide-item>
                </v-slide-group>
            </v-sheet>


            

        </v-row>


    </v-form>

</div>