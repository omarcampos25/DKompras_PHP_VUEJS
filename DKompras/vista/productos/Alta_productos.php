    <div id="CatalogoEmpleados" data-script="../../core/js/AltaProducto.js">
       
            <v-form>
                    <v-container>
                        <v-row>
                            <v-col cols="6" sm="6">
                                <v-container>
                                    <v-row>                                      
                                            <v-col cols="12" sm="12">
                                                <v-text-field
                                                    placeholder
                                                    v-model="codigo"
                                                    label="Codigo"
                                                    outlined
                                                    
                                                ></v-text-field>
                                            </v-col>

                                        </v-row>
                                        <v-row>
                                            
                                            <v-col cols="12" sm="6">
                                                <v-text-field
                                                v-model="descripcion"
                                                    label="Descripcion"
                                                    outlined
                                                ></v-text-field>
                                            </v-col>  

                                        </v-row>

                                        <v-row>
                                            
                                            <v-col cols="12" sm="6">
                                                <v-combobox
                                                v-model="select"
                                                    label="Selecciona una familia"
                                                    outlined
                                                    :items="items"
                                                ></v-combobox>
                                            </v-col>  

                                        </v-row>

                                        <v-row>
                                            
                                            <v-col cols="12" sm="6">
                                                <v-text-field
                                                v-model="precio"
                                                    label="Precio"
                                                    outlined
                                                    prefix="$"
                                                ></v-text-field>
                                            </v-col>  

                                        </v-row>

                                        <v-row>
                                            
                                            <v-col cols="12" sm="6">
                                                <v-text-field
                                                v-model="descuento"
                                                    placeholder
                                                    label="Descuento"
                                                    outlined
                                                    prefix="%"
                                                ></v-text-field>
                                            </v-col>

                                        </v-row>

                                    
                                        <v-row>
                                            
                                            <v-col cols="12" sm="6">
                                                <v-text-field
                                                v-model="cantidad"
                                                    placeholder
                                                    label="cantidad"
                                                    outlined
                                                    
                                                    
                                                ></v-text-field>
                                            </v-col>

                                        </v-row>
                                       
                                        <v-file-input label="File input" accept="image/*" @change="onChangePreView"  outlined dense></v-file-input>
                                        <br>
                                        <br>
                                        <br>
                                    
                                    <v-btn rounded color="primary" @click="RegistrarProductos" dark>Agregar Producto</v-btn>
                                </v-container>

                    <v-container>
                        <v-row>
                            </v-col>
                             <v-col cols="12" sm="6">
                             
                             
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <v-chip
                        class="ma-2"
                        color="primary"
                        v-if="imageBase64"
                        >
                        Vista previa
                        </v-chip>
                             <v-img
                             v-if="item.imageUrl" :src="item.imageUrl"
                             aspect-ratio="1"
                             class="grey lighten-2"
                             max-width="500"
                             max-height="300"
                            >
                            </v-col>

                            
                        </v-row>

                        <v-alert type="error" v-if="error" dismissible>
                         {{error}}
                        </v-alert>
                      
                    </v-container>   
            </v-form>
     
    </div>
  