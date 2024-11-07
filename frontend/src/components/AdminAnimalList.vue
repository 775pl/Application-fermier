<template>
  <div class="min-h-screen bg-gradient-to-r from-sky-50 to-pink-50 py-10">
    <h1 class="text-4xl font-extrabold text-center text-indigo-600 mb-10">Gestion des animaux</h1>

    <div class="max-w-6xl mx-auto px-4 mb-6">
      <!-- Bouton Ajouter un animal -->
      <button 
        @click="addAnimal" 
        class="w-full md:w-auto p-3 bg-indigo-500 text-white rounded-lg hover:bg-indigo-600 mb-6">
        Ajouter un animal
      </button>
    </div>

    <!-- Modal pour le formulaire d'ajout ou de modification -->
    <div v-if="showForm" class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50 z-50">
      <div class="bg-white p-6 rounded-lg shadow-lg w-full sm:w-96">
        <AnimalForm 
          :animal="selectedAnimal" 
          @save="saveAnimal" 
          @cancel="resetForm" 
          @close="resetForm"
        />
      </div>
    </div>

    <!-- Tableau des animaux -->
    <div class="overflow-x-auto max-w-6xl mx-auto px-4">
      <table class="min-w-full bg-white rounded-lg shadow-lg">
        <thead>
          <tr class="bg-indigo-500 text-white">
            <th class="py-3 px-6 text-left">Image</th>
            <th class="py-3 px-6 text-left">Nom</th>
            <th class="py-3 px-6 text-left">Âge</th>
            <th class="py-3 px-6 text-left">Type</th>
            <th class="py-3 px-6 text-left">Race</th>
            <th class="py-3 px-6 text-left">Description</th>
            <th class="py-3 px-6 text-left">Statut</th>
            <th class="py-3 px-6 text-left">Prix HT</th>
            <th class="py-3 px-6 text-left">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="animal in animals" :key="animal.id" class="border-t">
            <td class="py-3 px-6 text-center">
              <img v-if="animal.photos" :src="animal.photos" alt="Photo de l'animal" class="w-16 h-16 object-cover mx-auto" />
              <div v-else class="w-16 h-16 bg-gray-200 mx-auto flex items-center justify-center text-gray-500">
                <span class="text-xs">Pas d'image</span>
              </div>
            </td>
            <td class="py-3 px-6">{{ animal.name }}</td>
            <td class="py-3 px-6">{{ animal.age }}</td>
            <td class="py-3 px-6">{{ animal.type }}</td>
            <td class="py-3 px-6">{{ animal.breed }}</td>
            <td class="py-3 px-6">{{ animal.description }}</td>
            <td class="py-3 px-6">{{ animal.status }}</td>
            <td class="py-3 px-6">{{ animal.priceHT }} €</td>
            <td class="py-3 px-6 text-center space-x-2">
              <button @click="editAnimal(animal)" class="text-indigo-600 hover:text-indigo-800">
                <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path></svg>
              </button>
              <button @click="deleteAnimal(animal.id)" class="inline-flex items-center justify-center w-10 h-10 mr-2 text-gray-700 transition-colors duration-150 bg-white rounded-full focus:shadow-outline hover:bg-gray-200">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                </svg>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import AnimalForm from './AnimalForm.vue';


export default {
  components: { AnimalForm },
  data() {
    return {
      animals: [],
      selectedAnimal: null,
      showForm: false,
    };
  },
  methods: {
    async fetchAnimals() {
      const response = await axios.get(`http://localhost:8000/admin/animals`);
      this.animals = response.data;
    },
    addAnimal() {
      this.selectedAnimal = { // Initialise avec un objet vide
        id: '',
        name: '',
        age: '',
        type: '',
        breed: '',
        description: '',
        status: 'en vente',
        priceHT: '',
        photos: '',
    };
        this.showForm = true;
    },
    editAnimal(animal) {
      this.selectedAnimal = animal;
      this.showForm = true;
    },
    async saveAnimal(animal) {
        const animalData = {
            name: animal.name,
            age: animal.age,
            type: animal.type,
            breed: animal.breed,
            description: animal.description,
            status: animal.status,
            price_ht: animal.price_ht,
            photos: animal.photos || ""
        };
        try {
            if (animal.id) {
            await axios.put(`http://localhost:8000/admin/animal/${animal.id}`, animal);
            } else {
            await axios.post(`http://localhost:8000/admin/animal`, animal);
            }
            this.fetchAnimals();
            this.resetForm();
        } catch (error) {
            console.error('Erreur lors de la sauvegarde de l\'animal:', error);
        }
    },
    async deleteAnimal(id) {
      await axios.delete(`http://localhost:8000/admin/animal/${id}`);
      this.fetchAnimals();
    },
    resetForm() {
      this.showForm = false;
      this.selectedAnimal = null;
    }
  },
  mounted() {
    this.fetchAnimals();
  }
};
</script>
