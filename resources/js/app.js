import { createApp } from 'vue';
import store from './store/index';
import ExempleComponent from './components/ExempleComponent.vue';
import ProductAdd from './components/products/ProductAdd.vue';
import ShowError from './components/utils/ShowError.vue';
import ProductEdit from './components/products/ProductEdit.vue';
import StockManage from './components/stocks/StockManage.vue';
import ReturnProduct from './components/return_products/ReturnProduct.vue';
// import Select2 from 'vue3-select2-component';

const app = createApp({});


app.component('exemple-component', ExempleComponent);
app.component('show-error', ExempleComponent);
app.component('product-add', ProductAdd);
app.component('product-edit', ProductEdit);
app.component('stock-manage', StockManage);
app.component('return-product', ReturnProduct);
// app.component('Select2', Select2); // Register Select2 globally

app.use(store);
app.mount('#app');