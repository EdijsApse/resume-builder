<template>
    <div>
        <Header />
        <transition name="fade">
            <AlertMessage v-if="hasAlertMessage" />
        </transition>
        <router-view></router-view>
    </div>
</template>

<script>
    import Header from '@components/Header.vue';
    import { mapActions, mapState } from 'vuex';
    import AlertMessage from '@components/AlertMessage.vue'
    export default {
        computed: {
            ...mapState('alert', ['message']),
            hasAlertMessage() {
                return this.message !== null
            }
        },
        components: {
            Header,
            AlertMessage
        },
        methods: {
            ...mapActions('auth', ['loginFromLocalStorage'])
        },
        created() {
            this.loginFromLocalStorage();
        }
    }
</script>