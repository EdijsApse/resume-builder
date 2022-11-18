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
            ...mapActions('lists', ['loadLanguagesWithLevels']),
            async prepareApp() {
                this.isLoading = true;
                await this.loadLanguagesWithLevels()
                .finally(() => {
                    this.isLoading = false;
                })
            }
        },
        created() {
            this.prepareApp();
        }
    }
</script>