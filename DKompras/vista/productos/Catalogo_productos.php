
<div id="pro" data-script="../../core/js/CatalogoProductos.js">
<template>
    <v-data-table
      :headers="headers"
      :items="productos"
      sort-by="producto"
      class="elevation-1"
    >
    <template v-slot:item.foto="{ item }">
              <div class="p-2">
                <v-img v-bind:src="'data:image/jpeg;base64,'+item.foto" :alt="item.foto" width="50px" height="50px"></v-img>
              </div>
            </template>
      <template v-slot:top>
        <v-toolbar flat color="white">
        Catalogo de productos
          <v-divider
            class="mx-4"
            inset
            vertical
          ></v-divider>
          <v-spacer></v-spacer>
          <v-dialog v-model="dialog" max-width="500px">
            <template v-slot:activator="{ on, attrs }">
              <v-btn
                color="primary"
                dark
                class="mb-2"
                v-bind="attrs"
                v-on="on"
              >Nuevo producto</v-btn>
            </template> 
            <v-card>
              <v-card-title>
                <span class="headline">{{ formTitle }}</span>
              </v-card-title>

              <v-card-text>
                <v-container>
                <!--Card para edición-->
                <v-row>
                            <v-col cols="12" sm="12">
                                <v-container>
                                    <v-row>                                      
                                            <v-col cols="12" sm="12">
                                                <v-text-field
                                                    placeholder
                                                    v-model="editedItem.producto"
                                                    label="Producto"
                                                    outlined
                                                    
                                                ></v-text-field>
                                            </v-col>

                                        </v-row>
                                        <v-row>
                                            
                                            <v-col cols="12" sm="12">
                                                <v-text-field
                                                v-model="editedItem.descripcion"
                                                    label="Descripcion"
                                                    outlined
                                                ></v-text-field>
                                            </v-col>  

                                        </v-row>
                                       
                                        <v-row>
                                            
                                            <v-col cols="12" sm="12">
                                                <v-combobox
                                                    v-model="select"
                                                    label="Selecciona una familia"
                                                    outlined
                                                    :items="items"
                                                    item-value="idFamilia"
                                                    item-text="Familia"
                                                    
                                                ></v-combobox>
                                            </v-col>  

                                        </v-row>

                                        <v-row>
                                            
                                            <v-col cols="12" sm="12">
                                                <v-text-field
                                                v-model="editedItem.precio"
                                                    label="Precio"
                                                    outlined
                                                    prefix="$"
                                                ></v-text-field>
                                            </v-col>  

                                        </v-row>

                                        <v-row>
                                            
                                            <v-col cols="12" sm="12">
                                                <v-text-field
                                                v-model="editedItem.descuento"
                                                    placeholder
                                                    label="Descuento"
                                                    outlined
                                                    prefix="%"
                                                ></v-text-field>
                                            </v-col>

                                        </v-row>

                                    
                                        <v-row>
                                            
                                            <v-col cols="12" sm="12">
                                                <v-text-field
                                                v-model="editedItem.existencias"
                                                    placeholder
                                                    label="cantidad"
                                                    outlined
                                                    
                                                    
                                                ></v-text-field>
                                            </v-col>

                                        </v-row>
                                        <input type="file" accept="image/*" @change="onChangePreView" />
                                        <br>
                                        <br>
                                        <br>
                                    
                                      </v-container>

                    <v-container>
                        <v-row>

                </v-container>
              </v-card-text>

              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1"  @click="close">Cancelar</v-btn>
                <v-btn color="blue darken-1"  @click="save">Guardar</v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-toolbar>
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

