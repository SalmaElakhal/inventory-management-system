import * as mutations from '../../mutation-types'

export default {
    [mutations.SET_PRODUCTS](state, playoad){
        state.products = playoad
    }
} 