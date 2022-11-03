import { ADD_EXPERIENCE, ADD_IS_EXPERIENCE_LIST_VISIBLE, SET_EXPERIENCE_LIST, ADD_SELECTED_EXPERIENCE } from '@/store/mutations.js';

export default {
    namespaced: true,
    state: {
        items: [],
        selectedItem: null,
        isListVisible: false
    },
    mutations: {
        [ADD_EXPERIENCE](state, experience) {
            state.items.push(experience);
        },
        [ADD_SELECTED_EXPERIENCE](state, experience) {
            state.selectedItem = experience;
        },
        [SET_EXPERIENCE_LIST](state, list) {
            state.items = list;
        },
        [ADD_IS_EXPERIENCE_LIST_VISIBLE](state, visibilityState) {
            state.isListVisible = visibilityState;
        }
    },
    actions: {
        addItem({commit}, experience) {
            commit(ADD_EXPERIENCE, experience);
            commit(ADD_IS_EXPERIENCE_LIST_VISIBLE, true);
        },
        addListVisibilityState({commit}, visibilityState) {
            commit(ADD_IS_EXPERIENCE_LIST_VISIBLE, visibilityState);
        },
        deleteItem({commit, state}, id) {
            const newList = state.items.filter(exp => exp.id !== id);
            commit(SET_EXPERIENCE_LIST, newList);
        },
        updateItem({state, commit}, payload) {
            const { id, newItem } = payload;
            let newList = state.items.map((item) => {
                if (item.id === id) {
                    return newItem;
                }
                return item
            });

            commit(SET_EXPERIENCE_LIST, newList);
            commit(ADD_IS_EXPERIENCE_LIST_VISIBLE, true);
            commit(ADD_SELECTED_EXPERIENCE, null);
        },
        selectItem({ state, commit }, id) {
            const experience = state.items.find(exp => exp.id === id);
            if (experience) {
                commit(ADD_SELECTED_EXPERIENCE, experience);
                commit(ADD_IS_EXPERIENCE_LIST_VISIBLE, false);
            }
        },
        clearSelectedItem({ commit }) {
            commit(ADD_SELECTED_EXPERIENCE, null);
        }
    }
}