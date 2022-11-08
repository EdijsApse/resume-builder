import { ADD_USER, ADD_TOKEN } from '@/store/mutations.js';
import axios from  '@/axios.js';

const LOCAL_STORAGE_TOKEN_KEY = 'user_access_token';

export default {
    namespaced: true,
    state: {
        user: null,
        token: null
    },
    mutations: {
        [ADD_USER](state, user) {
            state.user = user;
        },
        [ADD_TOKEN](state, token) {
            state.token = token;
        }
    },
    actions: {
        authorizeUser({ commit }, payload) {
            const { user, token } = payload;
            axios.defaults.headers.common = {'Authorization': `Bearer ${token}`}
            localStorage.setItem(LOCAL_STORAGE_TOKEN_KEY, token);
            commit(ADD_TOKEN, user);
            commit(ADD_USER, token);
        },
        async register({ dispatch }, payload) {
            const { email, password, password_confirmation } = payload;
            await axios.post('/signup', { email, password, password_confirmation })
            .then((response) => {
                const { user, token } = response.data;
                dispatch('authorizeUser', {user, token});
            })
            .catch(error => Promise.reject(error))
        },
        async login({ dispatch }, payload) {
            const { email, password } = payload;
            await axios.post('/login', { email, password })
            .then((response) => {
                const { user, token, success, error } = response.data;
                if (success === true) {
                    dispatch('authorizeUser', {user, token});
                } else {
                    dispatch('alert/setErrorAlert', error, { root:true });
                }
                
            })
            .catch(error => {
                return Promise.reject(error);
            })
        },
        async loginFromLocalStorage({ commit }) {
            const token = localStorage.getItem(LOCAL_STORAGE_TOKEN_KEY);
            if (!token) {
                return;
            }
            axios.defaults.headers.common = {'Authorization': `Bearer ${token}`}
            axios.get('/user').then((response) => {
                const user = response;
                commit(ADD_TOKEN, user);
                commit(ADD_USER, token);
            }).catch(() => {
                localStorage.removeItem(LOCAL_STORAGE_TOKEN_KEY);
                delete axios.defaults.headers.common['Authorization'];
            })
        },
        logout() {
            localStorage.removeItem(LOCAL_STORAGE_TOKEN_KEY);
            location.reload();
        }
    }
}