import { ADD_LANGUAGE, ADD_IS_LANGUAGE_LIST_VISIBLE, SET_LANGUAGE_LIST, ADD_SELECTED_LANGUAGE } from '@/store/mutations.js';

export default {
    namespaced: true,
    state: {
        items: [],
        selectedItem: null,
        isListVisible: false,
        languages: [
            {
                value: 'lv',
                title: 'Latvian'
            },
            {
                value: 'eng',
                title: 'English'
            },
        ],
        levels: [
            {
                value: 'intermediate',
                title: 'Intermediate (B1)'
            },
            {
                value: 'advanced',
                title: 'Advanced'
            },
            {
                value: 'fluent',
                title: 'Proficient/Fluent (C2)'
            },
            {
                value: 'native',
                title: 'Native or bilingual'
            }
        ],
    },
    mutations: {
        [ADD_LANGUAGE](state, language) {
            state.items.push(language);
        },
        [ADD_SELECTED_LANGUAGE](state, language) {
            state.selectedItem = language;
        },
        [SET_LANGUAGE_LIST](state, list) {
            state.items = list;
        },
        [ADD_IS_LANGUAGE_LIST_VISIBLE](state, visibilityState) {
            state.isListVisible = visibilityState;
        }
    },
    actions: {
        addItem({commit}, language) {
            commit(ADD_LANGUAGE, language);
            commit(ADD_IS_LANGUAGE_LIST_VISIBLE, true);
        },
        addListVisibilityState({commit}, visibilityState) {
            commit(ADD_IS_LANGUAGE_LIST_VISIBLE, visibilityState);
        },
        deleteItem({commit, state}, id) {
            const newList = state.items.filter(lang => lang.id !== id);
            commit(SET_LANGUAGE_LIST, newList);
        },
        updateItem({state, commit}, payload) {
            const { id, newItem } = payload;
            let newList = state.items.map((item) => {
                if (item.id === id) {
                    return newItem;
                }
                return item
            });

            commit(SET_LANGUAGE_LIST, newList);
            commit(ADD_IS_LANGUAGE_LIST_VISIBLE, true);
            commit(ADD_SELECTED_LANGUAGE, null);
        },
        selectItem({ state, commit }, id) {
            const language = state.items.find(lang => lang.id === id);
            if (language) {
                commit(ADD_SELECTED_LANGUAGE, language);
                commit(ADD_IS_LANGUAGE_LIST_VISIBLE, false);
            }
        },
        clearSelectedItem({ commit }) {
            commit(ADD_SELECTED_LANGUAGE, null);
            commit(ADD_IS_LANGUAGE_LIST_VISIBLE, true);
        }
    }
}