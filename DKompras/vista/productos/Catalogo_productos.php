
<div id="pro" data-script="../../core/js/CatalogoProductos.js">

<template>
  <v-data-table
    :headers="headers"
    :items="productos"
    :sort-by="['calories', 'fat']"
    :sort-desc="[false, true]"
    multi-sort
    class="elevation-1"
  ></v-data-table>
</template>

</div>

