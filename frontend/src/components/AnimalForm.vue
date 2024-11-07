<template>
  <div v-if="showModal" class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50 z-50" @click="closeModal">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full sm:w-96" @click.stop>
      <h2 class="text-2xl font-bold text-indigo-600 mb-6">{{ animal.id ? 'Modifier' : 'Ajouter' }} un animal</h2>
      <form @submit.prevent="submitForm">
        <div class="mb-4">
          <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
          <input type="text" id="name" v-model="formData.name" required class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" />
        </div>

        <div class="mb-4">
          <label for="age" class="block text-sm font-medium text-gray-700">Âge</label>
          <input type="number" id="age" v-model="formData.age" required class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" />
        </div>

        <div class="mb-4">
          <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
          <select id="type" v-model="formData.type" required class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            <option value="chien">Chien</option>
            <option value="cheval">Cheval</option>
            <option value="brebis">Brebis</option>
            <option value="cochon">Cochon</option>
          </select>
        </div>

        <div class="mb-4">
          <label for="breed" class="block text-sm font-medium text-gray-700">Race</label>
          <select id="breed" v-model="formData.breed" required class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            <option value="labrador">Labrador</option>
            <option value="frison">Frison</option>
            <option value="pottok">Pottok</option>
            <option value="irish cob">Irish Cob</option>
            <option value="mérinos">Mérinos</option>
            <option value="solognotes">Solognotes</option>
          </select>
        </div>

        <div class="mb-4">
          <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
          <textarea id="description" v-model="formData.description" required class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"></textarea>
        </div>

        <div class="mb-4">
          <label for="status" class="block text-sm font-medium text-gray-700">Statut</label>
          <select id="status" v-model="formData.status" required class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            <option value="en vente">En vente</option>
            <option value="vendu">Vendu</option>
          </select>
        </div>

        <div class="mb-4">
          <label for="priceHT" class="block text-sm font-medium text-gray-700">Prix de vente HT (€)</label>
          <input type="number" id="priceHT" v-model="formData.priceHT" required class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" />
        </div>

        <div class="mb-4">
          <label for="photos" class="block text-sm font-medium text-gray-700">Photos (URLs, séparées par des virgules)</label>
          <input type="text" id="photos" v-model="formData.photos" placeholder="http://photo1.jpg, http://photo2.jpg" class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" />
        </div>

        <div class="flex justify-between">
          <button type="submit" class="w-full md:w-auto py-2 px-4 bg-indigo-500 text-white rounded-lg hover:bg-indigo-600 mb-4">{{ animal.id ? 'Mettre à jour' : 'Ajouter' }}</button>
          <button type="button" @click="cancelForm" class="w-full md:w-auto py-2 px-4 bg-gray-500 text-white rounded-lg hover:bg-gray-600 mb-4">Annuler</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    animal: {
      type: Object,
      default: () => ({}),
    },
  },
  data() {
    return {
      showModal: true,
      formData: {
        id: this.animal.id || '',
        name: this.animal.name || '',
        age: this.animal.age || '',
        type: this.animal.type || '',
        breed: this.animal.breed || '',
        description: this.animal.description || '',
        status: this.animal.status || 'en vente',
        priceHT: this.animal.priceHT || '',
        photos: Array.isArray(this.animal.photos) ? this.animal.photos.join(', ') : '',
      },
    };
  },
  methods: {
    submitForm() {
        this.formData.photos = this.formData.photos.split(',').map(photo => photo.trim()).join(', ');
        this.$emit('save', this.formData);
    this.closeModal();
    },
    cancelForm() {
      this.$emit('cancel');
      this.closeModal();
    },
    closeModal() {
      this.showModal = false;
      this.$emit('close');
    },
  },
  watch: {
    animal: {
      immediate: true,
      handler(newAnimal) {
        this.formData = {
          id: newAnimal.id || '',
          name: newAnimal.name || '',
          age: newAnimal.age || '',
          type: newAnimal.type || '',
          breed: newAnimal.breed || '',
          description: newAnimal.description || '',
          status: newAnimal.status || 'en vente',
          priceHT: newAnimal.priceHT || '',
          photos: typeof newAnimal.photos === 'string' ? newAnimal.photos : (Array.isArray(newAnimal.photos) ? newAnimal.photos.join(', ') : '')
        };
      },
    },
  },
};
</script>
