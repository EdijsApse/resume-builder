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
                                    <h2>Login</h2>
                                    <p>Sign in to download your resume</p>
                                </div>
                                <form @submit.prevent>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input id="email" type="email" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input id="password" type="password" class="form-control" />
                                    </div>
                                    <div class="auth-footer">
                                        <router-link :to="{ name: 'ForgetPassword' }">Forgot Your Password ?</router-link>
                                        <button class="btn btn-dark btn-sm">Login</button>
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