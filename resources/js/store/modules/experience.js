import { ADD_EXPERIENCE, SET_EXPERIENCE_LIST, ADD_SELECTED_EXPERIENCE } from '@/store/mutations.js';
import axios from '@/axios.js';

export default {
    namespaced: true,
    state: {
        items: [],
        selectedItem: null,
        itemsLoaded: false
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
        }
    },
    actions: {
        async loadItems({ commit, state }) {
            if (state.items.length) {
                return Promise.resolve();
            }
            await axios.get('/experiences').then(res => {
                const { experiences } = res.data;
                commit(SET_EXPERIENCE_LIST, experiences)
            })
        },

        async addItem({ commit, dispatch }, experience) {
            const data = {
                jobtitle: experience.jobtitle,
                employer: experience.employer,
                from: experience.from,
                to: experience.to,
                duties: experience.duties,
                is_current: experience.is_current,
            };

            await axios.post('/experience', data).then((response) => {
                const { success, experience } = response.data;
                if (success === true) {
                    commit(ADD_EXPERIENCE, experience);
                    dispatch('alert/setSuccessAlert', 'Job experience added to your resume!', { root:true });
                }
            }).catch(error => {
                return Promise.reject(error);
            })
        },

        async deleteItem({commit, state, dispatch}, id) {
            await axios.delete(`/experience/${id}`).then((response) => {
                const { success, error } = response.data;
                if (success === true) {
                    const newList = state.items.filter(exp => exp.id != id);
                    dispatch('alert/setSuccessAlert', 'Job experience removed from resume!', { root:true });
                    commit(SET_EXPERIENCE_LIST, newList);
                } else if (error) {
                    dispatch('alert/setErrorAlert', error, { root:true });
                }
            }).catch(err => {
                dispatch('alert/setErrorAlert', 'Ooops, error occured! Please try again later!', { root:true });
            });
        },
        
        async updateItem({ state, commit, dispatch }, experience) {
            const data = {
                jobtitle: experience.jobtitle,
                employer: experience.employer,
                from: experience.from,
                to: experience.to,
                duties: experience.duties,
                is_current: experience.is_current,
            };
            
            const selectedId = state.selectedItem.id;

            await axios.post(`/experience/${selectedId}`, data).then((response) => {
                const { success, experience } = response.data;
                if (success === true) {
                    const experiences = state.items.map(exp => {
                        if (exp.id === selectedId) {
                            return experience
                        }
                        return exp;
                    });
                    commit(SET_EXPERIENCE_LIST, experiences);
                    dispatch('alert/setSuccessAlert', 'Experience updated!', { root:true });
                }
            }).catch(error => {
                return Promise.reject(error);
            })
        },
        selectItem({ state, commit }, id) {
            const experience = state.items.find(exp => exp.id === id);
            if (experience) {
                commit(ADD_SELECTED_EXPERIENCE, experience);
            }
        },
        clearSelectedItem({ commit }) {
            commit(ADD_SELECTED_EXPERIENCE, null);
        }
    }
}