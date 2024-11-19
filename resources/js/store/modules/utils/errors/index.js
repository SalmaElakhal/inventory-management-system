import * as actions from './actions';
import getters from './getters'
import mutations from './mutations';


const state = {
    errors : [],
    is_errors: true,
   
}

export default {
    state, 
    actions, 
    getters, 
    mutations,
}