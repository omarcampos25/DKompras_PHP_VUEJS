<div id="sucursal" data-script="../../core/js/Sucursales.js">
  <template>
        <v-data-table
        :headers="headers"
        :items="sucursales"
        sort-by="sucursal"
        class="elevation-1"
        >
        <template v-slot:top>
            <v-toolbar flat color="white">
            Lista de sucursales
            <v-divider
                class="mx-4"
                inset
                vertical
            ></v-divider>
            <v-spacer></v-spacer>

            <!--Dialogo para insertar y editar-->
            <v-dialog v-model="dialog" max-width="500px">
                <template v-slot:activator="{ on, attrs }">
                <v-btn
                    color="primary"
                    dark
                    class="mb-2"
                    v-bind="attrs"
                    v-on="on"
                >Nueva Sucursal</v-btn>
                </template> 
                <v-card>
                <v-card-title>
                    <span class="headline">{{ formTitle }}</span>
                </v-card-title>

                <v-card-text>
                    <v-container>
                    <v-row>
                        <v-col cols="12" sm="6" md="4">
                        <v-text-field v-model="editedItem.sucursal" label="Sucursal"></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="6" md="4">
                        <v-text-field v-model="editedItem.direccion" label="Direccion"></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="6" md="4">
                        <v-text-field v-model="editedItem.ciudad" label="Ciudad"></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="6" md="4">
                        <v-text-field v-model="editedItem.estado" label="Estado"></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="6" md="4">
                        <v-text-field v-model="editedItem.telefonos" label="Telefono"></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="6" md="4">
                        <v-text-field v-model="editedItem.email" label="Email"></v-text-field>
                        </v-col>
                    </v-row>
                    
                    </v-container>
                </v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" text @click="close">Cancelar</v-btn>
                    <v-btn color="blue darken-1" text @click="save">Guardar</v-btn>
                </v-card-actions>
                </v-card>
            </v-dialog>


                <!--Dialogo para formas de pago-->
            <v-dialog v-model="dialogoPagos" max-width="500px">
                <template v-slot:activator="{ on, attrs }">
             
                </template> 
                <v-card>
                <v-card-title>
                    <span class="headline">Forma de pago</span>
                </v-card-title>

                <v-card-text>
                    <v-container>
                    <v-row>
                        <v-col cols="12" sm="6" md="12">
                        <v-chip
                        class="ma-2"
                        color="primary"
                        label
                        >
                        <v-icon left>mdi-credit-card</v-icon>
                        Seleccionas los Formas de pago
                        </v-chip>
                        </v-col>
                        <v-container fluid>
                        <v-row>
                        <v-col cols="12">
                            <v-combobox
                            v-model="selectPagos"
                            :items="itemsPagos"
                            label="Formas de pago"
                            item-value="idFormaPago"
                            item-text="FormaPago"
                            multiple
                            outlined
                            dense
                            ></v-combobox>
                        </v-col>
                        </v-row>
                    </v-container>
                    </v-row>
                    
                    </v-container>
                </v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" text @click="close">Cancelar</v-btn>
                    <v-btn color="blue darken-1" text @click="save">Guardar</v-btn>
                </v-card-actions>
                </v-card>
            </v-dialog>

              <!--Dialogo para formas de entrega-->
            <v-dialog v-model="dialogoEntregas" max-width="500px">
                <template v-slot:activator="{ on, attrs }">
             
                </template> 
                <v-card>
                <v-card-title>
                    <span class="headline">{{ formTitle }}</span>
                </v-card-title>

                <v-card-text>
                    <v-container>
                    <v-row>
                        <v-col cols="12" sm="6" md="12">
                        <v-chip
                        class="ma-2"
                        color="primary"
                        label
                        >
                        <v-icon left>mdi-train-car</v-icon>
                        Forma de entrega
                        </v-chip>
                        </v-col>
                        <v-container fluid>
                        <v-row>
                        <v-col cols="12">
                            <v-combobox
                            v-model="selectEntregas"
                            :items="itemsEntregas"
                            label="Formas de entrega"
                            item-value="idFormaEntrega"
                            item-text="FormaEntrega"
                            multiple
                            outlined
                            dense
                            ></v-combobox>
                        </v-col>
                        </v-row>
                    </v-container>
                    </v-row>
                    
                    </v-container>
                </v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" text @click="close">Cancelar</v-btn>
                    <v-btn color="blue darken-1" text @click="save">Guardar</v-btn>
                </v-card-actions>
                </v-card>
            </v-dialog>


            </v-toolbar>
        </template>
        <template v-slot:item.formas="{ item }">
            <v-icon
            
            class="mr-2"
            @click="ShowPagos(item)"
            >
            mdi-credit-card
            </v-icon>
            <v-icon
            
            @click="ShowEntregas(item)"
            >
            mdi-train-car
            </v-icon>
        </template>
        <template v-slot:item.actions="{ item }">
            <v-icon
            
            class="mr-2"
            @click="editItem(item)"
            >
            mdi-pencil
            </v-icon>
            <v-icon
            
            @click="deleteItem(item)"
            >
            mdi-delete
            </v-icon>
        </template>
        <template v-slot:no-data>
            <v-btn color="primary" @click="initialize">Reset</v-btn>
        </template>
        </v-data-table>
  </template>

</div>