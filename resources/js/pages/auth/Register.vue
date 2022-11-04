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
                                <form @submit.prevent>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input id="email" type="email" class="form-control" />
                                    </div>
                                    <div class="form-group-row">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input id="password" type="password" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label for="password_confirmation">Re-enter Password</label>
                                            <input id="password_confirmation" type="password" class="form-control" />
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