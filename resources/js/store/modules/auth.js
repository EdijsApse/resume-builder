import { ADD_USER, ADD_TOKEN, ADD_AUTH_FORM_ERRORS } from '@/store/mutations.js';
import axios from  '@/axios.js';

const FORM_ERROR_STATUS_CODE = 422;
const LOCAL_STORAGE_TOKEN_KEY = 'user_access_token';

export default {
    namespaced: true,
    state: {
        user: null,
        token: null,
        errors: {}
    },
    mutations: {
        [ADD_USER](state, user) {
            state.user = user;
        },
        [ADD_TOKEN](state, token) {
            state.token = token;
        },
        [ADD_AUTH_FORM_ERRORS](state, errors) {
            state.errors = errors;
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
        async register({ dispatch, commit }, payload) {
            const { email, password, password_confirmation } = payload;
            commit(ADD_AUTH_FORM_ERRORS, {});
            await axios.post('/signup', { email, password, password_confirmation })
            .then(response => {
                const { user, token } = response.data;
                dispatch('authorizeUser', {user, token});
            })
            .catch(error => {
                const { response } = error;
                if (response && response.status === FORM_ERROR_STATUS_CODE) {
                    let stateErrors = {};
                    const errors = response.data.errors;
                    for (const fields in errors) {
                        stateErrors[fields] = errors[fields][0];
                    }
                    commit(ADD_AUTH_FORM_ERRORS, stateErrors);
                }
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