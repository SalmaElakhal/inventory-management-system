import { createStore } from 'vuex';
import categories from './modules/categories';  // Importer le module des catégories
import brands from './modules/brands';  // Importer le module des catégories
import sizes from './modules/sizes';  // Importer le module des catégories
import products from './modules/products'
import errors from './modules/utils/errors'
import stocks from './modules/stocks'
import return_product from './modules/return_products'
const store = createStore({
  modules: {
    categories,  // Déclarer le module
    brands,
    sizes,
    products,
    errors,
    stocks,
    return_product,
  }
});


export default store;


