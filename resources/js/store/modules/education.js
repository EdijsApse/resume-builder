import { ADD_EDUCATION, SET_EDUCATION_LIST, ADD_SELECTED_EDUCATION } from '@/store/mutations.js';
import axios from '@/axios.js';
import i18n from '@/i18n/index.js';

export default {
    namespaced: true,
    state: {
        items: [],
        selectedItem: null
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
        }
    },
    actions: {
        async loadItems({ commit, state }) {
            if (state.items.length) {
                return Promise.resolve();
            }
            await axios.get('/education').then(res => {
                const { educations } = res.data;
                commit(SET_EDUCATION_LIST, educations)
            })
        },

        async addItem({ commit, dispatch }, education) {
            const data = {
                field: education.field,
                school: education.school,
                degree: education.degree,
                from: education.from,
                to: education.to,
                summary: education.summary,
                is_current: education.is_current,
            };

            await axios.post('/education', data).then((response) => {
                const { success, education } = response.data;
                if (success === true) {
                    commit(ADD_EDUCATION, education);
                    dispatch('alert/setSuccessAlert', i18n.t('alert.edu_added'), { root:true });
                }
            }).catch(error => {
                return Promise.reject(error);
            })
        },

        async deleteItem({commit, state, dispatch}, id) {
            await axios.delete(`/education/${id}`).then((response) => {
                const { success, error } = response.data;
                if (success === true) {
                    const newList = state.items.filter(edu => edu.id != id);
                    dispatch('alert/setSuccessAlert', i18n.t('alert.edu_deleted'), { root:true });
                    commit(SET_EDUCATION_LIST, newList);
                } else if (error) {
                    dispatch('alert/setErrorAlert', error, { root:true });
                }
            }).catch(err => {
                dispatch('alert/setErrorAlert', i18n.t('alert.server_error'), { root:true });
            });
        },

        async updateItem({ state, commit, dispatch }, education) {
            const data = {
                field: education.field,
                school: education.school,
                degree: education.degree,
                from: education.from,
                to: education.to,
                summary: education.summary,
                is_current: education.is_current,
            };
            
            const selectedId = state.selectedItem.id;

            await axios.post(`/education/${selectedId}`, data).then((response) => {
                const { success, education } = response.data;
                if (success === true) {
                    const educations = state.items.map(edu => {
                        if (edu.id === selectedId) {
                            return education
                        }
                        return edu;
                    });
                    commit(SET_EDUCATION_LIST, educations);
                    dispatch('alert/setSuccessAlert', i18n.t('alert.edu_updated'), { root:true });
                }
            }).catch(error => {
                return Promise.reject(error);
            })
        },

        selectItem({ state, commit }, id) {
            const education = state.items.find(edu => edu.id === id);
            if (education) {
                commit(ADD_SELECTED_EDUCATION, education);
            }
        },
        clearSelectedItem({ commit }) {
            commit(ADD_SELECTED_EDUCATION, null);
        }
    },
    getters: {
        hasEducations(state) {
            return state.items.length;
        }
    }
}