import * as mutations from '../../mutation-types'

export default {
    [mutations.SET_BRANDS](state, playoad){
        state.brands = playoad
    }
}