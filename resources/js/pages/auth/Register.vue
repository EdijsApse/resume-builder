<template>
    <base-container>
        <template #header>Login</template>
        <template #default>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="auth-container-wrapper">
                            <div class="auth-container">
                                <div class="auth-header">
                                    <h2>Don't have an Account? Register Now.</h2>
                                    <p>Create free account, create your resume and edit it whenever needed!</p>
                                </div>
                                <form @submit.prevent="signup">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input id="email" type="email" class="form-control" v-model="email" />
                                        <p v-if="errors['email']" class="form-error">{{ errors['email'] }}</p>
                                    </div>
                                    <div class="form-group-row">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input id="password" type="password" class="form-control" v-model="password" />
                                            <p v-if="errors['password']" class="form-error">{{ errors['password'] }}</p>
                                        </div>
                                        <div class="form-group">
                                            <label for="password_confirmation">Re-enter Password</label>
                                            <input id="password_confirmation" type="password" class="form-control" v-model="password_confirmation" />
                                            <p v-if="errors['password_confirmation']" class="form-error">{{ errors['password_confirmation'] }}</p>
                                        </div>
                                    </div>
                                    <div class="auth-footer">
                                        <button class="btn btn-dark w-100">Register</button>
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
    import { mapActions, mapState } from 'vuex';
    export default {
        data() {
            return {
                email: '',
                password: '',
                password_confirmation: ''
            }
        },
        computed: {
            ...mapState('auth', ['errors'])
        },
        methods: {
            ...mapActions('auth', ['register']),
            signup() {
                this.register({
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation
                });
            }
        }
    }
</script>