import * as mutations from '../../mutation-types'

export default {
    [mutations.SET_ERRORS](state, playoad){
        state.is_errors = true
        state.error = playoad
    }
}