<div id="consulta" data-script="../../core/js/ProductosConsultados.js">
    <v-form>
        <v-row>

            <v-col cols="3" sm="3" md="3">
            </v-col>
            <v-col cols="9" sm="9" md="9">

                <v-list>

                    <v-list-item v-for="item in items" :key="item.title" @click="MostrarDetalleProducto(item.idProducto)">
                        <v-card elevation="24" class="ma-1" width="1000"  class="mx-auto">
                            <v-row>
                                <v-col cols="1" sm="1" md="1">
                                   
                                </v-col>
                                <v-col cols="2" sm="2" md="2">
                                    <v-img width="160" height="160" :alt="item.imagen"
                                        v-bind:src="'data:image/jpeg;base64,'+item.imagen"></v-img>
                                </v-col>
                                <v-col cols="9" sm="9" md="9">
                                    <v-list-item-content>
                                        <v-list-item-title class="text-h5 mb-1 text-left" v-text="item.codigo"></v-list-item-title>
                                        <v-list-item-title  prefix="$" class="text-h5 mb-1 text-left" > ${{item.precio}}</v-list-item-title>
                                   
                                    </v-list-item-content>
                                </v-col>
                            </v-row>
                        </v-card>
                    </v-list-item>

                </v-list>
            </v-col>
        </v-row>
    </v-form>




</div>