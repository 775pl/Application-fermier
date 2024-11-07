// src/App.vue

<template>
  <div id="app">
    <router-view />  <!-- C'est ici que le composant correspondant à la route sera affiché -->
  </div>
</template>

<script>
// Importer le composant AnimalList
import AnimalList from './components/AnimalList.vue';
import AdminAnimalList from './components/AdminAnimalList.vue';
import AnimalForm from './components/AnimalForm.vue';


export default {
  name: 'App',
  components: {
    AnimalList, AdminAnimalList, AnimalForm
  }
};
</script>

<style>
/* Ajoute ici tes styles globaux */
</style>
