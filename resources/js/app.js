import { createApp } from 'vue';
import store from './store/index';
import ExempleComponent from './components/ExempleComponent.vue';
import ProductAdd from './components/products/ProductAdd.vue';

// import Select2 from 'vue3-select2-component';

const app = createApp({});


app.component('exemple-component', ExempleComponent);
app.component('product-add', ProductAdd);
// app.component('Select2', Select2); // Register Select2 globally

app.use(store);
app.mount('#app');