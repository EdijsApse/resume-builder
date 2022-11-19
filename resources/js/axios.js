import Axios from "axios";
import i18n from '@/i18n/index.js';

const instance = Axios.create({
    baseURL: process.env.MIX_VUE_API_URL,
    timeout: 10000
});

const responseSuccessHandler = response => response;
const responseErrorHandler = error => {
    if (error.response.status === 401) {
        alert('Unauthorized');
    }
    return Promise.reject(error);
}

const requestSuccessHandler = (config) => {
    config.headers['X-LOCALE'] = i18n.locale;
    return config;
}
const requestErrorHandler = (error) => {
    return Promise.reject(error);
}

instance.interceptors.request.use(requestSuccessHandler, requestErrorHandler);
instance.interceptors.response.use(responseSuccessHandler, responseErrorHandler);

export default instance;