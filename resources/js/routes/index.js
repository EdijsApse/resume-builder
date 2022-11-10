import Vue from 'vue'
import VueRouter from 'vue-router'
import store from '@/store/index.js';

Vue.use(VueRouter)

import HomePage from '@/pages/Home.vue';
import LoginPage from '@/pages/auth/Login.vue';
import RegisterPage from '@/pages/auth/Register.vue';
import CreateResumePage from '@/pages/resume/Create.vue';
import PreviewResumePage from '@/pages/resume/Preview.vue';

const guestOnlyMeta = {
    guestOnly: true
}

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
    },
    {
        name: 'Login',
        path: '/login',
        component: LoginPage,
        meta: guestOnlyMeta
    },
    {
        name: 'Register',
        path: '/register',
        component: RegisterPage,
        meta: guestOnlyMeta
    },
];

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

router.beforeEach((to, from, next) => {
    if (to.meta.guestOnly === true && store.state.auth.user !== null) {
        return next({ name: 'Home' });
    }
    return next()
})

export default router;