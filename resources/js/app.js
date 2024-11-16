import { createApp } from 'vue'; // Importation de createApp au lieu de Vue
import store from './store'
// Importation des composants
import ExempleComponent from './components/ExempleComponent.vue';
import ProductAdd from './components/products/Productadd.vue';



// Création de l'application et enregistrement des composants
const app = createApp({
    store,
    components: {
        ExempleComponent,
        ProductAdd
    }
});

// Montée de l'application sur l'élément HTML avec l'ID 'app'
app.mount('#app');
