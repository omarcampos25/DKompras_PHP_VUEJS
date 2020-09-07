
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
                <v-img v-bind:src="'data:image/jpeg;base64,'+item.foto" :alt="item.foto" width="100px" height="100px"></v-img>
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
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field v-model="editedItem.familia" label="Familia"></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-img v-bind:src="'data:image/jpeg;base64,'+editedItem.foto"  width="100px" height="100px"></v-img>
                    </v-col> 
                  </v-row>
                  <v-row> 
                    <v-col cols="12" sm="12" md="4">
                      Imagen
                      <input type="file"   accept="image/*" @change="onChangePreView" />
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

