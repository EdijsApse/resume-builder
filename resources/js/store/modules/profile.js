import { ADD_BASIC_INFORMATION } from '@/store/mutations.js';
import axios from '@/axios.js';

export default {
    namespaced: true,
    state: {
        profile: null,
    },
    mutations: {
        [ADD_BASIC_INFORMATION](state, profile) {
            state.profile = profile;
        }
    },
    actions: {
        async loadUserProfile({ commit, getters }) {
            if (!getters.hasProfileCreated) {
                await axios.get('/profile').then((response) => {
                    const { profile } = response.data;
                    commit(ADD_BASIC_INFORMATION, profile)
                })
            }
        },
        async saveUserProfile({ commit, dispatch }, payload) {
            const formData = new FormData();

            formData.append('name', payload.name);
            formData.append('surname', payload.surname);
            formData.append('phone', payload.phone);
            formData.append('occupation', payload.occupation);
            formData.append('professional_summary', payload.professional_summary);
            formData.append('address', payload.address);
            formData.append('image', payload.file);

            if (payload.website) {
                formData.append('website', payload.website);
            }

            await axios.post('/profile', formData)
            .then((response) => {
                const { profile, success } = response.data;
                if (success === true) {
                    commit(ADD_BASIC_INFORMATION, profile);
                    dispatch('alert/setSuccessAlert', 'Basic information saved!', { root:true });
                }
            }).catch(error => Promise.reject(error))
        }
    },
    getters: {
        hasProfileCreated(state) {
            return state.profile !== null
        }
    }
}