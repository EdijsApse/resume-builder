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
    import axios from '@/axios.js';

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
                await this.loadLanguagesWithLevels().then(() => {
                    return this.loadTranslations();
                })
                .finally(() => {
                    this.isLoading = false;
                })
            },
            async loadTranslations() {
                await axios.get(`/messages/${this.$i18n.locale}`).then((response) => {
                    const { messages } = response.data;
                    this.$i18n.setLocaleMessage(this.$i18n.locale, messages);
                });
            }
        },
        created() {
            this.prepareApp();
        }
    }
</script>