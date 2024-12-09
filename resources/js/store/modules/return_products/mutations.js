import * as mutations from '../../mutation-types'

export default {
    [mutations.SET_RETURN_PRODUCT](state, playoad){
        state.products = playoad
    }
} 