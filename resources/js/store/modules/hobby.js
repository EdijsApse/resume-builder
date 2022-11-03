import { ADD_HOBBY, SET_HOBBIES_LIST } from '@/store/mutations.js';

export default {
    namespaced: true,
    state: {
        items: [],
    },
    mutations: {
        [ADD_HOBBY](state, skill) {
            state.items.push(skill);
        },
        [SET_HOBBIES_LIST](state, list) {
            state.items = list;
        },
    },
    actions: {
        addItem({commit}, skill) {
            commit(ADD_HOBBY, skill)
        },
        removeItem({commit, state}, id) {
            const skills = state.items.filter(skill => skill.id !== id);
            commit(SET_HOBBIES_LIST, skills);
        }
    }
}