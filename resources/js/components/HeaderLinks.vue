<template>
    <div class="collapse navbar-collapse">
        <div class="navbar-mobile-header">
            <div class="logo">
                <img src="/images/logo.png" alt="My Resume logo" />
            </div>
            <div class="close-icon" @click="hideMobileNav">
                <i class="fa-solid fa-xmark"></i>
            </div>
        </div>
        <ul class="navbar-nav">
            <li class="nav-item">
                <router-link to="/" class="nav-link">{{ $t('general.header.home') }}</router-link>
            </li>
            <li class="nav-item" v-if="isSignedIn">
                <router-link to="/create" class="nav-link">{{ $t('general.header.create') }}</router-link>
            </li>
            <li class="nav-item" v-if="isSignedIn">
                <router-link to="/preview" class="nav-link">{{ $t('general.header.preview') }}</router-link>
            </li>
            <li class="nav-item" v-if="isAdmin">
                <router-link to="/admin/languages" class="nav-link" :class="[{'router-link-exact-active': isAdminPage}]">{{ $t('general.header.admin') }}</router-link>
            </li>
        </ul>
        <div class="auth-action-box" v-if="!isSignedIn">
            <router-link :to="{ name: 'Login' }" class="btn btn-primary btn-transparent">{{ $t('general.header.sign_in') }}</router-link>
            <router-link :to="{ name: 'Register' }" class="btn btn-primary">{{ $t('general.header.create_account') }}</router-link>
        </div>
        <div class="user-profile-box" v-else>
            <button class="btn btn-primary btn-transparent" @click="logout">{{ $t('general.header.logout') }}</button>
        </div>
    </div>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex';
    export default {
        data() {
            return {
                isMobileNavbarVisible: false
            }
        },
        emits: ['hide-mobile-nav'],
        computed: {
            ...mapGetters('auth', ['isSignedIn', 'isAdmin']),
            isAdminPage() {
                return this.$route.path.includes('/admin');
            }
        },
        methods: {
            ...mapActions('auth', ['logout']),
            hideMobileNav() {
                this.$emit('hide-mobile-nav');
            }
        },
        watch: {
            '$route': function() {
                this.hideMobileNav();
            }
        }
    }
</script>


<style scoped lang="scss">
    @import '@style/_variables.scss';
    .navbar-collapse {
        justify-content: space-between;
        @media (max-width: $screen-lg) {
            padding: $space-8;
        }

        @media (max-width: $screen-sm) {
            padding: $space-4;
        }
        .navbar-mobile-header {
            display: none;
            @media (max-width: $screen-lg) {
                display: flex;
                max-width: 500px;
                margin-left: auto;
                margin-right: auto;
                justify-content: space-between;
                align-items: center;
            }
            .logo {
                width: 200px;
                img {
                    width: 100%;
                }
            }
            .close-icon {
                font-size: 2rem;
                color: $dark-gray;
            }
        }
        .auth-action-box {
            display: flex;
            margin-left: -$space-2;
            margin-right: -$space-2;
            @media (max-width: $screen-lg) {
                max-width: 500px;
                justify-content: space-between;
                margin: 0 auto;
            }
            .btn {
                margin-left: $space-2;
                margin-right: $space-2;
                min-width: 140px;
                @media (max-width: $screen-lg) {
                    margin-left: 0;
                    margin-right: 0;
                    width: 49%;
                }
                &.btn-transparent {
                    background-color: transparent;
                    color: #FFF;
                    border-color: #FFF;
                    @media (max-width: $screen-lg) {
                        color: $dark-gray;
                        border-color: $dark-gray;
                        &:hover {
                            color: $dark-gray;
                            border-color: $dark-gray !important;
                        }
                    }
                    &:hover {
                        background-color: #FFF;
                        border-color: #FFF;
                        color: $dark-gray;
                    }
                }
            }
        }
        .user-profile-box {
            display: flex;
            align-items: center;
            @media (max-width: $screen-lg) {
                max-width: 500px;
                margin: 0 auto;
            }
            .btn {
                @media (max-width: $screen-lg) {
                    width: 100%;
                }
            }
        }
        &.desktop-visible {
            display: flex !important;
            @media (max-width: $screen-lg) {
                display: none !important;
                max-width: 500px;
                margin: $space-8 auto;
            }
        }
        &.mobile-visible {
            position: fixed;
            display: none !important;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #FFF;
            @media (max-width: $screen-lg) {
                display: block !important;
            }
        }
        .navbar-nav {
            margin-left: -0.25rem;
            margin-right: -0.25rem;
            @media (max-width: $screen-xl) {
                margin-right: auto;
                margin-left: auto;
            }
            @media (max-width: $screen-lg) {
                display: block;
                max-width: 500px;
                margin: $space-8 auto;
            }
            .nav-item {
                &:last-of-type {
                    .nav-link {
                        @media (max-width: $screen-lg) {
                            margin-bottom: 0;
                        }
                    }
                }
            }
            .nav-link {
                color: #FFF;
                font-size: 0.9rem;
                padding: $space-2 $space-6;
                border-radius: 50px;
                margin-left: 0.25rem;
                margin-right: 0.25rem;
                transition: all 0.3s;
                @media (max-width: $screen-lg) {
                    border: 1px solid $dark-gray;
                    color: $dark-gray;
                    text-align: center;
                    margin-left: 0;
                    margin-right: 0;
                    margin-bottom: $space-4;
                    &.router-link-exact-active {
                        border: 1px solid $orange;
                    }
                    &:hover {
                        border: 1px solid $orange;
                    }
                }
                &.router-link-exact-active {
                    background-color: $orange;
                    color: #FFF;
                }
                &:hover {
                    background-color: $orange;
                    color: #FFF;
                }
            }
        }
    }
</style>