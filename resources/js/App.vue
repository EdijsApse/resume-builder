<template>
    <transition name="fade" mode="out-in">
        <div v-if="!isLoading">
            <Header />
            <transition name="fade">
                <AlertMessage v-if="hasAlertMessage" />
            </transition>
            <router-view></router-view>
        </div>
        <LoadingSpinner v-else />
    </transition>
</template>

<script>
    import Header from '@components/Header.vue';
    import { mapActions, mapState } from 'vuex';
    import AlertMessage from '@components/AlertMessage.vue'
    export default {
        data() {
            return {
                isLoading: false
            }
        },
        computed: {
            ...mapState('alert', ['message']),
            ...mapState('auth', ['user']),
            hasAlertMessage() {
                return this.message !== null
            }
        },
        components: {
            Header,
            AlertMessage
        },
        methods: {
            ...mapActions('auth', ['loginFromLocalStorage']),
            async prepareApp() {
                this.isLoading = true;
                await this.loginFromLocalStorage().finally(() => {
                    if (this.$route.meta.guestOnly && this.user !== null) {
                        this.$router.replace({name: 'Home'})
                    } else if (this.$route.meta.userOnly && this.user === null) {
                        this.$router.replace({name: 'Login'})
                    }
                    this.isLoading = false;
                })
            }
        },
        created() {
            this.prepareApp();
        }
    }
</script>