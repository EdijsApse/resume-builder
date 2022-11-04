<template>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <router-link to="/" class="brand">
                <img src="@images/logo.png" alt="My Resume logo" />
            </router-link>
            <button class="navbar-toggler">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <router-link to="/" class="nav-link">Home</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/create" class="nav-link">Create</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/preview" class="nav-link">Preview</router-link>
                    </li>
                </ul>
                <div class="auth-action-box">
                    <router-link :to="{ name: 'Login' }" class="btn btn-primary btn-transparent">Sign in</router-link>
                    <router-link :to="{ name: 'Register' }" class="btn btn-primary">Create account</router-link>
                </div>
            </div>
        </div>
    </nav>
</template>

<style scoped lang="scss">
    @import '@style/_variables.scss';
    .navbar-expand-lg {
        position: fixed;
        top: 0px;
        width: 100%;
        padding: $space-4 0;
        background-color: rgba($color: #000000, $alpha: 0.2);
        z-index: 1;
        .brand {
            width: 200px;
            margin-right: 5rem;
            img {
                width: 100%;
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