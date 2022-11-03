import { ADD_EDUCATION, ADD_IS_EDUCATION_LIST_VISIBLE, SET_EDUCATION_LIST, ADD_SELECTED_EDUCATION } from '@/store/mutations.js';

export default {
    namespaced: true,
    state: {
        items: [],
        selectedItem: null,
        isListVisible: false
    },
    mutations: {
        [ADD_EDUCATION](state, education) {
            state.items.push(education);
        },
        [ADD_SELECTED_EDUCATION](state, education) {
            state.selectedItem = education;
        },
        [SET_EDUCATION_LIST](state, list) {
            state.items = list;
        },
        [ADD_IS_EDUCATION_LIST_VISIBLE](state, visibilityState) {
            state.isListVisible = visibilityState;
        }
    },
    actions: {
        addItem({commit}, education) {
            commit(ADD_EDUCATION, education);
            commit(ADD_IS_EDUCATION_LIST_VISIBLE, true);
        },
        addListVisibilityState({commit}, visibilityState) {
            commit(ADD_IS_EDUCATION_LIST_VISIBLE, visibilityState);
        },
        deleteItem({commit, state}, id) {
            const newList = state.items.filter(edu => edu.id !== id);
            commit(SET_EDUCATION_LIST, newList);
        },
        updateItem({state, commit}, payload) {
            const { id, newItem } = payload;
            let newList = state.items.map((item) => {
                if (item.id === id) {
                    return newItem;
                }
                return item
            });

            commit(SET_EDUCATION_LIST, newList);
            commit(ADD_IS_EDUCATION_LIST_VISIBLE, true);
            commit(ADD_SELECTED_EDUCATION, null);
        },
        selectItem({ state, commit }, id) {
            const education = state.items.find(edu => edu.id === id);
            if (education) {
                commit(ADD_SELECTED_EDUCATION, education);
                commit(ADD_IS_EDUCATION_LIST_VISIBLE, false);
            }
        },
        clearSelectedItem({ commit }) {
            commit(ADD_SELECTED_EDUCATION, null);
            commit(ADD_IS_EDUCATION_LIST_VISIBLE, true);
        }
    }
}