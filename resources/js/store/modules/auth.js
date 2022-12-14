import { ADD_USER, ADD_TOKEN, SET_IS_USER_LOADED } from '@/store/mutations.js';
import axios from  '@/axios.js';

const LOCAL_STORAGE_TOKEN_KEY = 'user_access_token';

export default {
    namespaced: true,
    state: {
        user: null,
        token: null,
        isUserLoaded:false
    },
    mutations: {
        [ADD_USER](state, user) {
            state.user = user;
        },
        [ADD_TOKEN](state, token) {
            state.token = token;
        },
        [SET_IS_USER_LOADED](state) {
            state.isUserLoaded = true;
        }
    },
    actions: {
        authorizeUser({ commit }, payload) {
            const { user, token } = payload;
            axios.defaults.headers.common = {'Authorization': `Bearer ${token}`}
            localStorage.setItem(LOCAL_STORAGE_TOKEN_KEY, token);
            commit(ADD_TOKEN, token);
            commit(ADD_USER, user);
            commit(SET_IS_USER_LOADED);
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
                    return Promise.reject({});
                }
            })
            .catch(error => {
                return Promise.reject(error);
            })
        },
        async loginFromLocalStorage({ dispatch, commit }) {
            let token = localStorage.getItem(LOCAL_STORAGE_TOKEN_KEY);
            if (!token) {
                return;
            }
            axios.defaults.headers.common = {'Authorization': `Bearer ${token}`}
            await axios.get('/user', {
                headers: {
                    'Accept': 'application/json'
                }
            }).then((response) => {
                const { user } = response.data;
                dispatch('authorizeUser', {user, token});
            }).catch((err) => {
                localStorage.removeItem(LOCAL_STORAGE_TOKEN_KEY);
                delete axios.defaults.headers.common['Authorization'];
            }).finally(() => {
                commit(SET_IS_USER_LOADED);
            })
        },
        logout() {
            localStorage.removeItem(LOCAL_STORAGE_TOKEN_KEY);
            location.reload();
        }
    },
    getters: {
        isSignedIn(state) {
            return state.user !== null
        },
        isAdmin(state) {
            if (state.user === null) {
                return false;
            };
            return state.user.is_admin;
        }
    }
}