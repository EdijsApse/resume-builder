<template>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <div class="left-side">
                <router-link to="/" class="brand">
                    <img src="/images/logo.png" alt="My Resume logo" />
                </router-link>
                <div class="dropdown relative">
                    <transition name="fade">
                        <div class="spinner-border" v-if="isLoading"></div>
                    </transition>
                    <span @click="isLangDropdownVisible = !isLangDropdownVisible">{{ $i18n.locale.toUpperCase() }} <i class="fa-solid fa-caret-down"></i></span>
                    <transition name="fade">
                        <ul class="dropdown-menu" v-if="isLangDropdownVisible">
                            <li :class="[{'isSelected': $i18n.locale === 'lv'}]" @click="loadTrasnslations('lv')">LV</li>
                            <li :class="[{'isSelected': $i18n.locale === 'en'}]" @click="loadTrasnslations('en')">ENG</li>
                        </ul>
                    </transition>
                </div>
            </div>
            <button class="navbar-toggler">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse">
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
                    <router-link :to="{ name: 'Profile' }" class="nav-link">{{ $t('general.header.profile') }}</router-link>
                    <button class="btn btn-primary btn-transparent" @click="logout">{{ $t('general.header.logout') }}</button>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
    import { mapState, mapActions, mapGetters } from 'vuex';
    import axios from '@/axios.js';

    export default {
        data() {
            return {
                isLangDropdownVisible: false,
                isLoading: false
            }
        },
        computed: {
            ...mapState('auth', ['user']),
            ...mapGetters('auth', ['isSignedIn', 'isAdmin']),
            isAdminPage() {
                return this.$route.path.includes('/admin');
            }
        },
        methods: {
            ...mapActions('auth', ['logout']),
            async loadTrasnslations(locale) {
                if (locale === this.$i18n.locale) {
                    return;
                }
                this.isLoading = true;
                await axios.get(`/messages/${locale}`).then((response) => {
                    const { messages } = response.data;
                    this.$i18n.locale = locale;
                    this.$i18n.setLocaleMessage(locale, messages);
                    axios.defaults.headers.common['X-LOCALE'] = locale;
                    localStorage.setItem('preselected_locale', locale);
                    this.isLangDropdownVisible = false;
                }).finally(() => {
                    this.isLoading = false;
                })
            }
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
            .dropdown {
                margin-left: $space-6;
                span {
                    font-size: 1rem;
                    font-weight: bold;
                    color: #FFF;
                    cursor: pointer;
                    i {
                        margin-left: $space-4;
                    }
                }
                .dropdown-menu {
                    display: block;
                    top: 50px;
                    min-width: 65px;
                    left: -7.5px;
                    box-shadow: 0px 0px 3px 0px $darkish-gray;
                    border: none;
                    border-radius: 5px;
                    padding: 0;
                    li {
                        font-size: 1rem;
                        color: $dark-gray;
                        border-bottom: 1px solid $brightish-gray;
                        padding: $space-2;
                        cursor: pointer;
                        transition: all 0.3s;
                        &.isSelected {
                            color: $pink;
                        }
                        &:hover {
                            color: $pink;
                        }
                        &:last-of-type {
                            border-bottom: none;
                        }
                    }
                }
            }
            .brand {
                width: 200px;
                img {
                    width: 100%;
                }
            }

            .spinner-border {
                position: absolute;
                top: 5px;
                right: -35px;
                border-color: $pink;
                width: 1rem;
                height: 1rem;
                border-width: 0.2rem;
                border-right-color: transparent;
            }
        }
        .navbar-collapse {
            justify-content: space-between;
            .auth-action-box {
                display: flex;
                margin-left: -$space-2;
                margin-right: -$space-2;
                .btn {
                    margin-left: $space-2;
                    margin-right: $space-2;
                    min-width: 140px;
                    &.btn-transparent {
                        background-color: transparent;
                        color: #FFF;
                        border-color: #FFF;
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
                .nav-link {
                    color: #FFF;
                    font-size: 0.9rem;
                    padding: $space-2 $space-6;
                }
                .btn {
                    margin-left: $space-4;
                }
            }
        }
        .navbar-nav {
            margin-left: -0.25rem;
            margin-right: -0.25rem;
            .nav-link {
                color: #FFF;
                font-size: 0.9rem;
                padding: $space-2 $space-6;
                border-radius: 50px;
                margin-left: 0.25rem;
                margin-right: 0.25rem;
                transition: all 0.3s;
                &.router-link-exact-active {
                    background-color: $orange;
                }
                &:hover {
                    background-color: $orange;
                }
            }
        }
    }
</style>