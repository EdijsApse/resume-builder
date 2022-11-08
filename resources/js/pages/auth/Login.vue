<template>
    <base-container>
        <template #header>Login</template>
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
                                    <h2>Login</h2>
                                    <p>Sign in to download your resume</p>
                                </div>
                                <form @submit.prevent="signin">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input id="email" type="email" class="form-control" v-model="email" />
                                        <p v-if="errors['email']" class="form-error">{{ errors['email'] }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input id="password" type="password" class="form-control" v-model="password" />
                                        <p v-if="errors['password']" class="form-error">{{ errors['password'] }}</p>
                                    </div>
                                    <div class="auth-footer">
                                        <button class="btn btn-dark btn-sm">Login</button>
                                        <router-link :to="{ name: 'ForgetPassword' }">Forgot Your Password ?</router-link>
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
                errors: {},
                isLoading: false
            }
        },
        methods: {
            ...mapActions('auth', ['login']),
            signin() {
                this.isLoading = true;
                this.errors = {};
                this.login({
                    email: this.email,
                    password: this.password
                })
                .catch(error => {
                    const { response } = error;
                    if (response && response.status === FORM_ERROR_STATUS_CODE) {
                        this.errors = mapInputErrors(response.data.errors);
                    }
                }).finally(() => {
                    this.isLoading = false;
                });
            }
        }
    }
</script>