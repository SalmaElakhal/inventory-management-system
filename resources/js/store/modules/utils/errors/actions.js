// export default {
//     myAction(context, payload) {
//         // Logique ici
//     },
// };

export const myAction = ({ commit }, payload) => {
    // Exemple d'action
    commit('SET_ERRORS', payload);
};
