import { ADD_ALERT_MESSAGE } from '@/store/mutations.js';

export default {
    namespaced: true,
    state: {
        isSuccess: false,
        message: null
    },
    mutations: {
        [ADD_ALERT_MESSAGE](state, {isSuccess, message}) {
            state.message = message;
            state.isSuccess = isSuccess;
        },
    },
    actions: {
        setErrorAlert({commit}, message) {
            commit(ADD_ALERT_MESSAGE, {
                message: message,
                isSuccess: false
            })
        },
        setSuccessAlert({commit}, message) {
            commit(ADD_ALERT_MESSAGE, {
                message: message,
                isSuccess: true
            })
        },
        resetMessage({commit}) {
            commit(ADD_ALERT_MESSAGE, {
                isSuccess: false, 
                message: null
            });
        }
    }
}