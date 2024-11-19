import { createStore } from 'vuex';
import categories from './modules/categories';  // Importer le module des catégories
import brands from './modules/brands';  // Importer le module des catégories
import sizes from './modules/sizes';  // Importer le module des catégories
import products from './modules/products'
import errors from './modules/utils/errors'

const store = createStore({
  modules: {
    categories,  // Déclarer le module
    brands,
    sizes,
    products,
    errors,
  }
});

// export default new Vuex.Store({
//     module : {
//         categories,
//     }
// })
export default store;

// import Vue from 'vue'
// import Vuex from 'vuex'


// Vue.use(Vuex)

// //Modules
// import categories from './modules/categories';

