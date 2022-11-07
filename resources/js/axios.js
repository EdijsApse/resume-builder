import Axios from "axios";

const instance = Axios.create({
    baseURL: process.env.MIX_VUE_API_URL,
    timeout: 10000,
});

const successHandler = response => response;
const errorHandler = error => {
    if (error.response.status === 401) {
        alert('Unauthorized');
    }
    return Promise.reject(error);
}

instance.interceptors.response.use(successHandler, errorHandler);

export default instance;