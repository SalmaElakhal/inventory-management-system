import './bootstrap';
import { createApp } from 'vue';
import ExempleComponent from './components/ExempleComponent.vue';

const app = createApp(  {});
app.component('exemple-component', ExempleComponent);
app.mount('#app');
 