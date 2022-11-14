import { ADD_CERTIFICATE, SET_CERTIFICATE_LIST, ADD_SELECTED_CERTIFICATE } from '@/store/mutations.js';
import axios from '@/axios.js';

export default {
    namespaced: true,
    state: {
        items: [],
        selectedItem: null
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
    },
    actions: {
        async loadItems({ commit, state }) {
            if (state.items.length) {
                return Promise.resolve();
            }
            await axios.get('/certificates').then(res => {
                const { certificates } = res.data;
                commit(SET_CERTIFICATE_LIST, certificates)
            })
        },
        async addItem({ commit, dispatch }, certificate) {
            const data = {
                name: certificate.name,
                organization: certificate.organization,
                issued: certificate.issued,
            };

            await axios.post('/certificates', data).then((response) => {
                const { success, certificate } = response.data;
                if (success === true) {
                    commit(ADD_CERTIFICATE, certificate);
                    dispatch('alert/setSuccessAlert', 'Certificate added to your resume!', { root:true });
                }
            }).catch(error => {
                return Promise.reject(error);
            })
        },
        async deleteItem({commit, state, dispatch}, id) {
            await axios.delete(`/certificate/${id}`).then((response) => {
                const { success, error } = response.data;
                if (success === true) {
                    const newList = state.items.filter(cert => cert.id != id);
                    dispatch('alert/setSuccessAlert', 'Certificate removed from resume!', { root:true });
                    commit(SET_CERTIFICATE_LIST, newList);
                } else if (error) {
                    dispatch('alert/setErrorAlert', error, { root:true });
                }
            }).catch(err => {
                dispatch('alert/setErrorAlert', 'Ooops, error occured! Please try again later!', { root:true });
            });
        },
        async updateItem({ state, commit, dispatch }, certificate) {
            const data = {
                name: certificate.name,
                organization: certificate.organization,
                issued: certificate.issued,
            };
            
            const selectedId = state.selectedItem.id;

            await axios.post(`/certificate/${selectedId}`, data).then((response) => {
                const { success, certificate } = response.data;
                if (success === true) {
                    const certificates = state.items.map(cert => {
                        if (cert.id === selectedId) {
                            return certificate
                        }
                        return cert;
                    });
                    commit(SET_CERTIFICATE_LIST, certificates);
                    dispatch('alert/setSuccessAlert', 'Certificate updated!', { root:true });
                }
            }).catch(error => {
                return Promise.reject(error);
            })
        },
        selectItem({ state, commit }, id) {
            const certificate = state.items.find(edu => edu.id === id);
            if (certificate) {
                commit(ADD_SELECTED_CERTIFICATE, certificate);
            }
        },
        clearSelectedItem({ commit }) {
            commit(ADD_SELECTED_CERTIFICATE, null);
        }
    },
    getters: {
        hasCertificates(state) {
            return state.items.length;
        }
    }
}