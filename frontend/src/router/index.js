// src/router/index.js

import { createRouter, createWebHistory } from 'vue-router';
import AnimalList from '../components/AnimalList.vue';
import AdminAnimalList from '../components/AdminAnimalList.vue';  

const routes = [
  {
    path: '/api/animals',
    name: 'AnimalList',
    component: AnimalList,
  },
  {
    path: '/admin/animals',  // Route vers le tableau de bord
    name: 'AdminAnimalList',
    component: AdminAnimalList,
  }
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
