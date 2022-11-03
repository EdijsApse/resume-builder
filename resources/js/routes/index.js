import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import HomePage from '@/pages/Home.vue';
import CreateResumePage from '@/pages/resume/Create.vue';
import PreviewResumePage from '@/pages/resume/Preview.vue';

const routes = [
    {
        name: 'CreateResume',
        path: '/create',
        component: CreateResumePage
    },
    {
        name: 'PreviewResume',
        path: '/preview',
        component: PreviewResumePage
    },
    {
        name: 'Home',
        path: '/',
        component: HomePage
    },
    {
        name: 'Layouts',
        path: '/layouts'
    }
];

export default new VueRouter({
    mode: 'history',
    routes: routes
})