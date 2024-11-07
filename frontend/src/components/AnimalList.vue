<template>
  <div class="min-h-screen bg-gradient-to-r from-sky-50 to-pink-50 py-10">
    <h1 class="text-4xl font-extrabold text-center text-indigo-600 mb-10">Nos animaux à vendre</h1>

    <!-- Filtres -->
    <div class="max-w-6xl mx-auto px-4 mb-6 flex flex-col md:flex-row gap-4 items-center">
      <select v-model="filters.type" class="w-full md:w-1/4 p-2 border border-gray-300 rounded-lg bg-white">
        <option value="">Tous les types</option>
        <option value="chien">Chien</option>
        <option value="cheval">Cheval</option>
        <option value="brebis">Brebis</option>
        <option value="cochon">Cochon</option>
      </select>

      <select v-model="filters.breed" class="w-full md:w-1/4 p-2 border border-gray-300 rounded-lg bg-white">
        <option value="">Toutes les races</option>
        <option value="labrador">Labrador</option>
        <option value="frison">Frison</option>
        <option value="pottok">Pottok</option>
        <option value="irish cob">Irish Cob</option>
        <option value="mérinos">Mérinos</option>
        <option value="solognotes">Solognotes</option>
      </select>

      <input
        type="number"
        v-model.number="filters.maxPrice"
        placeholder="Prix max"
        class="w-full md:w-1/4 p-2 border border-gray-300 rounded-lg bg-white"
      />
      <button @click="resetFilters" class="w-full md:w-1/4 p-2 bg-indigo-500 text-white rounded-lg hover:bg-indigo-600">
        Réinitialiser
      </button>
    </div>

    <!-- Liste d'animaux -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto px-4">
      <div v-for="animal in filteredAnimals" :key="animal.name" class="animal-card rounded-lg shadow-lg overflow-hidden bg-white hover:shadow-xl transform hover:scale-105 transition duration-300">
        <img v-if="animal.photos" :src="animal.photos" alt="Photo de l'animal" class="w-full h-48 object-cover rounded-t-lg" />
        <div v-else class="w-full h-48 flex items-center justify-center bg-gray-200 rounded-t-lg text-gray-500 text-xl">
          Aucune image
        </div>
        <div class="p-6">
          <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold text-gray-800">{{ animal.name }}</h2>
            <p class="text-lg font-bold text-indigo-500">{{ (animal.priceHT * 1.2).toFixed(2) }} €</p>
          </div>
          <div class="space-y-2 text-gray-700">
            <p><strong>Âge :</strong> {{ animal.age }} {{ animal.age === 1 ? 'an' : 'ans' }}</p>
            <p><strong>Type :</strong> {{ animal.type }}</p>
            <p><strong>Race :</strong> {{ animal.breed }}</p>
            <p><strong>Description :</strong> {{ animal.description }}</p>
          </div>
          <button @click="callFarm(animal)" class="w-full mt-4 p-2 bg-green-500 text-white rounded-lg hover:bg-green-600">
            Appeler la ferme
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import axios from 'axios';


const animals = ref([]);
const filters = ref({
  type: '',
  breed: '',
  maxPrice: null,
});

onMounted(() => {
  axios.get(`%VUE_APP_API_URL%/admin/animals`)
    .then(response => {
      animals.value = response.data;
    })
    .catch(error => {
      console.error('Erreur lors de la récupération des animaux:', error);
    });
});

const filteredAnimals = computed(() => {
  return animals.value.filter(animal => {
    return (
      (!filters.value.type || animal.type === filters.value.type) &&
      (!filters.value.breed || animal.breed === filters.value.breed) &&
      (!filters.value.maxPrice || animal.price * 1.2 <= filters.value.maxPrice)
    );
  });
});

function resetFilters() {
  filters.value = { type: '', breed: '', maxPrice: null };
}

function callFarm(animal) {
  window.location.href = 'tel:+33123456789';
}
</script>
