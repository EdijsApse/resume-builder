import { SET_RESUME_SKILLS } from '@/store/mutations.js';
import axios from '@/axios.js';

export default {
    namespaced: true,
    state: {
        skills: null,
    },
    mutations: {
        [SET_RESUME_SKILLS](state, skills) {
            state.skills = skills;
        },
    },
    actions: {
        async loadItems({ commit, getters }) {
            if (getters.hasSkills) {
                return Promise.resolve();
            }
            await axios.get('/skills').then((response) => {
                const { skills } = response.data;
                if (skills) {
                    commit(SET_RESUME_SKILLS, skills)
                }
            })
        },
        async saveItems({ commit, dispatch }, items) {
            await axios.post('/skills', { list: items })
            .then((response) => {
                const { success, skills } = response.data;
                if (success) {
                    commit(SET_RESUME_SKILLS, skills)
                    dispatch('alert/setSuccessAlert', 'Skills list saved!', { root:true });
                }
            }).catch(err => {
                console.log(err);
            })
        },
    },
    getters: {
        hasSkills(state) {
            return state.skills !== null
        },
        skillList(state) {
            return state.skills.list ?? [];
        }
    }
}