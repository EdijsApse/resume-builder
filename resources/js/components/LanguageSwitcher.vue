<template>
    <div class="dropdown relative">
        <transition name="fade">
            <div class="spinner-border" v-if="isLoading"></div>
        </transition>
        <span @click.stop="isLangDropdownVisible = !isLangDropdownVisible">{{ $i18n.locale.toUpperCase() }} <i class="fa-solid fa-caret-down"></i></span>
        <transition name="fade">
            <ul class="dropdown-menu" v-if="isLangDropdownVisible">
                <li :class="[{'isSelected': $i18n.locale === 'lv'}]" @click="loadTrasnslations('lv')">LV</li>
                <li :class="[{'isSelected': $i18n.locale === 'en'}]" @click="loadTrasnslations('en')">ENG</li>
            </ul>
        </transition>
    </div>
</template>

<script>
    import axios from '@/axios.js';

    export default {
        data() {
            return {
                isLangDropdownVisible: false,
                isLoading: false,
            }
        },
        methods: {
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
            },
        },
        mounted() {
            document.body.addEventListener('click', (e) => {
                if (!e.target.closest('.dropdown-menu li') && this.isLangDropdownVisible) {
                    this.isLangDropdownVisible = false;
                } 
            })
        }
    }
</script>

<style scoped lang="scss">
    @import '@style/_variables.scss';
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
</style>