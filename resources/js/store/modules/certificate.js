import { ADD_CERTIFICATE, ADD_IS_CERTIFICATE_LIST_VISIBLE, SET_CERTIFICATE_LIST, ADD_SELECTED_CERTIFICATE } from '@/store/mutations.js';

export default {
    namespaced: true,
    state: {
        items: [],
        selectedItem: null,
        isListVisible: false
    },
    mutations: {
        [ADD_CERTIFICATE](state, certificate) {
            state.items.push(certificate);
        },
        [ADD_SELECTED_CERTIFICATE](state, certificate) {
            state.selectedItem = certificate;
        },
        [SET_CERTIFICATE_LIST](state, list) {
            state.items = list;
        },
        [ADD_IS_CERTIFICATE_LIST_VISIBLE](state, visibilityState) {
            state.isListVisible = visibilityState;
        }
    },
    actions: {
        addItem({commit}, certificate) {
            commit(ADD_CERTIFICATE, certificate);
            commit(ADD_IS_CERTIFICATE_LIST_VISIBLE, true);
        },
        addListVisibilityState({commit}, visibilityState) {
            commit(ADD_IS_CERTIFICATE_LIST_VISIBLE, visibilityState);
        },
        deleteItem({commit, state}, id) {
            const newList = state.items.filter(cert => cert.id !== id);
            commit(SET_CERTIFICATE_LIST, newList);
        },
        updateItem({state, commit}, payload) {
            const { id, newItem } = payload;
            let newList = state.items.map((item) => {
                if (item.id === id) {
                    return newItem;
                }
                return item
            });

            commit(SET_CERTIFICATE_LIST, newList);
            commit(ADD_IS_CERTIFICATE_LIST_VISIBLE, true);
            commit(ADD_SELECTED_CERTIFICATE, null);
        },
        selectItem({ state, commit }, id) {
            const certificate = state.items.find(cert => cert.id === id);
            if (certificate) {
                commit(ADD_SELECTED_CERTIFICATE, certificate);
                commit(ADD_IS_CERTIFICATE_LIST_VISIBLE, false);
            }
        },
        clearSelectedItem({ commit }) {
            commit(ADD_SELECTED_CERTIFICATE, null);
            commit(ADD_IS_CERTIFICATE_LIST_VISIBLE, true);
        }
    }
}