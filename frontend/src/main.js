import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import './assets/styles/style.css';

const app = createApp(App);

// Utilisation du router
app.use(router);

app.mount('#app');
