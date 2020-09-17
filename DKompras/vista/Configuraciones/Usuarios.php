<div id="user" data-script="../../core/js/Usuarios.js">
  <template>
    <v-data-table
      :headers="headers"
      :items="usuarios"
      sort-by="nombre"
      class="elevation-1"
    >
   
      <template v-slot:top>
        <v-toolbar flat color="white">
        Lista de usuarios
          <v-divider
            class="mx-4"
            inset
            vertical
          ></v-divider>
          <v-spacer></v-spacer>
          <v-dialog v-model="dialog" max-width="500px">
            <template v-slot:activator="{ on, attrs }">
              <v-btn
                x-large
                color="primary"
                dark
                class="mb-2"
                v-bind="attrs"
                v-on="on"
              >Nuevo usuario</v-btn>
            </template> 
            <v-card>
              <v-card-title>
                <span class="headline">{{ formTitle }}</span>
              </v-card-title>

              <v-card-text  >
                <v-container>
                  <v-row>
                    <v-col cols="12" sm="12" md="12">
                      <v-text-field v-model="editedItem.nombre" label="Nombre"></v-text-field>
                    </v-col>
                    
                  </v-row>
                  <v-row>
                   
                    <v-col cols="12" sm="12" md="12">
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
    <v-dialog
      v-model="load"
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
  </template>

</div>