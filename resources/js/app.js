import Vue from 'vue';
import App from './components/ExampleComponent.vue';

new Vue({
    render: function (h) {
        return h(App)
    },
}).$mount('#app');