<template>
    <base-container>
        <template #header>{{ $t('general.auth_pages.create_account') }}</template>
        <template #default>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="auth-container-wrapper">
                            <div class="auth-container relative">
                                <transition name="fade">
                                    <LoadingSpinner v-if="isLoading" />
                                </transition>
                                <div class="auth-header">
                                    <h2>{{ $t('general.auth_pages.create_account_title') }}</h2>
                                    <p>{{ $t('general.auth_pages.create_account_info_text') }}</p>
                                </div>
                                <form @submit.prevent="signup">
                                    <div class="form-group">
                                        <label for="email">{{ $t('resume.email') }}</label>
                                        <input id="email" type="email" class="form-control" v-model="email" />
                                        <p v-if="errors['email']" class="form-error">{{ errors['email'] }}</p>
                                    </div>
                                    <div class="form-group-row">
                                        <div class="form-group">
                                            <label for="password">{{ $t('general.auth_pages.password') }}</label>
                                            <input id="password" type="password" class="form-control" v-model="password" />
                                            <p v-if="errors['password']" class="form-error">{{ errors['password'] }}</p>
                                        </div>
                                        <div class="form-group">
                                            <label for="password_confirmation">{{ $t('general.auth_pages.password_confimration') }}</label>
                                            <input id="password_confirmation" type="password" class="form-control" v-model="password_confirmation" />
                                            <p v-if="errors['password_confirmation']" class="form-error">{{ errors['password_confirmation'] }}</p>
                                        </div>
                                    </div>
                                    <div class="auth-footer">
                                        <button class="btn btn-dark w-100">{{ $t('general.auth_pages.register') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </base-container>
</template>

<script>
    import { mapActions } from 'vuex';
    import { FORM_ERROR_STATUS_CODE, mapInputErrors } from '@/helpers.js';

    export default {
        data() {
            return {
                email: '',
                password: '',
                password_confirmation: '',
                errors: {},
                isLoading: false
            }
        },
        methods: {
            ...mapActions('auth', ['register']),
            signup() {
                this.isLoading = true;
                this.errors = {};
                this.register({
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation
                }).then(() => {
                    this.$router.replace({name: 'CreateResume'})
                }).catch(error => {
                    const { response } = error;
                    if (response && response.status === FORM_ERROR_STATUS_CODE) {
                        this.errors = mapInputErrors(response.data.errors);
                    }
                }).finally(() => {
                    this.isLoading = false;
                })
            }
        }
    }
</script>