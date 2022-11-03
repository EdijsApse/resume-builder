import { ADD_SKILL, SET_SKILLS_LIST } from '@/store/mutations.js';

export default {
    namespaced: true,
    state: {
        items: [],
    },
    mutations: {
        [ADD_SKILL](state, skill) {
            state.items.push(skill);
        },
        [SET_SKILLS_LIST](state, list) {
            state.items = list;
        },
    },
    actions: {
        addItem({commit}, skill) {
            commit(ADD_SKILL, skill)
        },
        removeItem({commit, state}, id) {
            const skills = state.items.filter(skill => skill.id !== id);
            commit(SET_SKILLS_LIST, skills);
        }
    }
}