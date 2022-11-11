import Vue from 'vue'
import router from '@/routes';
import store from '@/store';
import App from './App.vue'
import BaseContainer from '@components/ui/BaseContainer.vue';
import BaseResumeItem from '@components/ui/BaseResumeItem.vue';
import BaseListItem from '@components/ui/BaseListItem.vue';
import BaseResumeSectionHeader from '@components/ui/BaseResumeSectionHeader.vue';
import LoadingSpinner from '@components/LoadingSpinner.vue';
import DatePicker from 'vue2-datepicker';

Vue.component('base-container', BaseContainer);
Vue.component('base-resume-item', BaseResumeItem);
Vue.component('base-list-item', BaseListItem);
Vue.component('base-resume-section-header', BaseResumeSectionHeader);
Vue.component('date-picker', DatePicker);

Vue.component('LoadingSpinner', LoadingSpinner);

Vue.filter('toHumanReadable', function (date) {
    const newDate = new Date(date);
    if (!newDate) return '';

    return newDate.toLocaleString('en-US', {
        month: 'long',
        year: 'numeric'
    });
})

new Vue({
    store,
    router,
    render: function (h) {
        return h(App)
    },
}).$mount('#app')