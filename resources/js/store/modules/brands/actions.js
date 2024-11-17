import * as actions from '../../action-types';
import * as mutations from '../../mutation-types';
import Axios from 'axios'

export default {
  [actions.GET_BRANDS]({ commit }) {
    Axios.get('/api/brands')
      .then(response => {
        if (response.data.success == true) {
          commit(mutations.SET_BRANDS, response.data.data)
        }
      })
      .catch(err => {
        console.log(err.response)
      }
      )
  }
}