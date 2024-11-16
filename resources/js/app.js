import { createApp } from 'vue'; // Importation de Vue 3
import ExempleComponent from './components/ExempleComponent.vue';
import ProductAdd from './components/products/ProductAdd.vue';

// Créer l'application Vue
const app = createApp({});

// Enregistrer les composants
app.component('exemple-component', ExempleComponent);
app.component('product-add', ProductAdd);

// Monter l'application sur l'élément avec id "app"
app.mount('#app');
