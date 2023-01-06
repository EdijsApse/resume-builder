import { ADD_LANGUAGE, SET_LANGUAGE_LIST, ADD_SELECTED_LANGUAGE } from '@/store/mutations.js';
import axios from '@/axios.js';
import i18n from '@/i18n/index.js';

export default {
    namespaced: true,
    state: {
        items: [],
        selectedItem: null
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
        }
    },
    actions: {
        async loadItems({ commit, state }) {
            if (state.items.length) {
                return Promise.resolve();
            }
            await axios.get('/resume-languages').then(res => {
                const { languages } = res.data;
                commit(SET_LANGUAGE_LIST, languages)
            })
        },
        async addItem({ commit, dispatch }, language) {
            const data = {
                language_id: language.language_id,
                level_id: language.level_id,
            };

            await axios.post('/resume-language', data).then((response) => {
                const { success, language } = response.data;
                if (success === true) {
                    commit(ADD_LANGUAGE, language);
                    dispatch('alert/setSuccessAlert', i18n.t('alert.lang_added'), { root:true });
                }
            }).catch(error => {
                return Promise.reject(error);
            })
        },
        async deleteItem({commit, state, dispatch}, id) {
            await axios.delete(`/resume-language/${id}`).then((response) => {
                const { success, error } = response.data;
                if (success === true) {
                    const newList = state.items.filter(lang => lang.id != id);
                    dispatch('alert/setSuccessAlert', i18n.t('alert.lang_deleted'), { root:true });
                    commit(SET_LANGUAGE_LIST, newList);
                } else if (error) {
                    dispatch('alert/setErrorAlert', error, { root:true });
                }
            }).catch(err => {
                dispatch('alert/setErrorAlert', i18n.t('alert.server_error'), { root:true });
            });
        },
        async updateItem({ state, commit, dispatch }, language) {
            const data = {
                language_id: language.language_id,
                level_id: language.level_id,
            };
            
            const selectedId = state.selectedItem.id;

            await axios.post(`/resume-language/${selectedId}`, data).then((response) => {
                const { success, language } = response.data;
                if (success === true) {
                    const languages = state.items.map(lang => {
                        if (lang.id === selectedId) {
                            return language
                        }
                        return lang;
                    });
                    commit(SET_LANGUAGE_LIST, languages);
                    dispatch('alert/setSuccessAlert', i18n.t('alert.lang_updated'), { root:true });
                }
            }).catch(error => {
                return Promise.reject(error);
            })
        },
        selectItem({ state, commit }, id) {
            const language = state.items.find(lang => lang.id === id);
            if (language) {
                commit(ADD_SELECTED_LANGUAGE, language);
            }
        },
        clearSelectedItem({ commit }) {
            commit(ADD_SELECTED_LANGUAGE, null);
        }
    },
    getters: {
        hasLanguages(state) {
            return state.items.length;
        }
    }
}