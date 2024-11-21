import * as actions from '../../action-types';
import * as mutations from '../../mutation-types';
import Axios from 'axios'
export default {
  [actions.ADD_PRODUCT]({ commit }, payload) {
    Axios.post('/products', payload)
      .then(response => {
        if(response.data.success == true){
          window.location.href = '/products';
        }
      })
      .catch(err => {
        // console.log(err.response.data)
        commit(mutations.SET_ERRORS, err.response.data.errors)
      }
      )
  },

  [actions.EDIT_PRODUCT]({ commit }, payload) {
   return  Axios.post(`/products/${payload.id}`, payload.data)
      .then(response => {
        if(response.data.success == true){
          window.location.href = '/products';
        }
      })
      .catch(err => {
        // console.log(err.response.data)
        commit(mutations.SET_ERRORS, err.response.data.errors)
      }
      )
  }
}