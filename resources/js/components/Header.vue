<template>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <div class="left-side">
                <router-link to="/" class="brand">
                    <img src="/images/logo.png" alt="My Resume logo" />
                </router-link>
                <LanguageSwitcher />
            </div>
            <button class="navbar-toggler" @click="isMobileNavbarVisible = true">
                <i class="fa-solid fa-bars"></i>
            </button>
            <HeaderLinks class="desktop-visible" />
            
            <transition name="fade">
                <HeaderLinks class="mobile-visible" v-if="isMobileNavbarVisible" @hide-mobile-nav="isMobileNavbarVisible = false" />
            </transition>
        </div>
    </nav>
</template>

<script>
    import HeaderLinks from '@components/HeaderLinks.vue';
    import LanguageSwitcher from '@components/LanguageSwitcher.vue';

    export default {
        data() {
            return {
                isMobileNavbarVisible: false
            }
        },
        components: {
            HeaderLinks,
            LanguageSwitcher
        }
    }
</script>

<style scoped lang="scss">
    @import '@style/_variables.scss';
    .navbar-expand-lg {
        position: fixed;
        top: 0px;
        width: 100%;
        padding: $space-4 0;
        background-color: rgba($color: #000000, $alpha: 0.2);
        z-index: 1;
        .left-side {
            display: flex;
            margin-right: 5rem;
            align-items: center;
            flex-wrap: nowrap;
            @media (max-width: $screen-xl) {
                margin-right: 0rem;
            }
            .brand {
                width: 200px;
                @media (max-width: $screen-xl) {
                    width: 150px;
                }
                img {
                    width: 100%;
                }
            }
        }
        .navbar-toggler {
            color: #FFF;
            border: 1px solid #FFF;
            &:focus {
                box-shadow: none;
            }
            &:focus-visible {
                outline: none;
            }
        }
    }
</style>