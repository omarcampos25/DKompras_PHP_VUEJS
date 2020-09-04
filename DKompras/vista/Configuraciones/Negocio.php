
<div  id="negocio" data-script="../../core/js/Negocio.js">


<v-form>
                    <v-container>
                        <v-row>
                            <v-col cols="6" sm="6">
                                <v-container>
                                <v-row>
                
                                            <v-col cols="12" sm="6">
                                               

                                                <v-chip
                                                x-large
                                                class="ma-2"
                                                color="green"
                                                text-color="white"
                                                large
                                                >
                                                Licencia hasta {{licencia}}
                                                </v-chip>
                                            </v-col>

                                        </v-row>
                                    <v-row>                                      
                                            <v-col cols="12" sm="12">
                                                <v-text-field
                                                    placeholder
                                                    v-model="nombreNegocio"
                                                    label="Nombre de la empresa"
                                                    outlined
                                                    
                                                ></v-text-field>
                                            </v-col>

                                        </v-row>
                                        <v-dialog
                                            v-model="dialog"
                                            hide-overlay
                                            persistent
                                            width="700"
                                            
                                            >
                                            <v-card
                                                color="primary"
                                                dark
                                            >
                                                <v-card-text>
                                                {{mensajeDialogo}}
                                                <v-progress-linear
                                                    indeterminate
                                                    color="white"
                                                    class="mb-0"
                                                ></v-progress-linear>
                                                </v-card-text>
                                            </v-card>
                                            </v-dialog>
                                        <v-row>
                                            
                                            <v-col cols="12" sm="12">
                                                <v-text-field
                                                v-model="email"
                                                    label="Correo electronico"
                                                    outlined
                                                ></v-text-field>
                                            </v-col>  

                                        </v-row>

                                        <v-row>
                                            
                                            <v-col cols="12" sm="12">
                                            <v-text-field
                                                v-model="direccion"
                                                    label="Direccion"
                                                    outlined
                                                ></v-text-field>
                                            </v-col>  

                                        </v-row>

                                        <v-row>
                                            
                                            <v-col cols="12" sm="12">
                                                <v-text-field
                                                v-model="ciudad"
                                                    label="Ciudad"
                                                    outlined
                                            
                                                ></v-text-field>
                                            </v-col>  

                                        </v-row>

                                        <v-row>
                                            
                                            <v-col cols="12" sm="12">
                                                <v-text-field
                                                v-model="estado"
                                                    placeholder
                                                    label="Estado"
                                                    outlined
                                                    
                                                ></v-text-field>
                                            </v-col>

                                        </v-row>

                                    
                                        <v-row>
                                            
                                            <v-col cols="12" sm="12">
                                                <v-text-field
                                                v-model="telefono"
                                                    placeholder
                                                    label="Telefono"
                                                    outlined
                                                    
                                                    
                                                ></v-text-field>
                                            </v-col>

                                        </v-row>

                                        
                                        <input type="file" accept="image/*" @change="onChangePreView" />
                                        <br>
                                        <br>
                                        <br>
                                    
                                    <v-btn x-large rounded block color="primary" @click="ActualizarDatos" dark>Guardar</v-btn>
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
                        
                        >
                        Logo de la empresa
                        </v-chip>
                             <v-img
                             v-if="imagen" :src="imagen"
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

                        <v-alert type="success" v-if="mensaje" dismissible >
                        {{mensaje}}
                        </v-alert>
                      
                    </v-container>   
            </v-form>




</div>


