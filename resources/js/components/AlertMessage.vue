<template>
    <div class="alert" :class="[{ 'alert-success': isSuccess, 'alert-error': !isSuccess }]">
        <span class="close-btn" @click="closeAlert">
            <i class="fa-sharp fa-solid fa-circle-xmark"></i>
        </span>
        <div class="alert-content">
            <div class="alert-image">
                <img :src="alertImage" />
            </div>
            <div class="content">
                <h2>{{ alertTitle }}</h2>
                <p>
                    {{ message }}
                </p>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapState, mapActions } from 'vuex';

    export default {
        data() {
            return {
                closingTimeout: null
            }
        },
        computed: {
            ...mapState('alert', ['isSuccess', 'message']),
            alertTitle() {
                return this.isSuccess === true ? 'Successful' : 'Attention'
            },
            alertImage() {
                return this.isSuccess === true ? require('@images/success-alert.png') : require('@images/error-alert.png')
            }
        },
        methods: {
            ...mapActions('alert', ['resetMessage']),
            closeAlert() {
                this.resetMessage();
                clearTimeout(this.closingTimeout);
            }
        },
        mounted() {
            this.closingTimeout = setTimeout(() => {
                this.resetMessage();
            }, 3000);
        }
    }
</script>

<style scoped lang="scss">
    @import '@style/_variables.scss';
    .alert {
        position: fixed;
        top: 30px;
        left: 30px;
        z-index: 9999;
        width: 25rem;
        background-color: #FFF;
        padding: $space-4;
        border: none;
    }
    .alert-success {
        .close-btn {
            color: $success;
        }    
    }
    .alert-error {
        .close-btn {
            color: $pink;
        }    
    }
    .close-btn {
        position: absolute;
        right: 10px;
        top: 5px;
        font-size: 1.4rem;
        cursor: pointer;
    }
    h2 {
        font-family: $open-sans-regular;
        font-size: 1.5rem;
        margin-bottom: $space-1;
        color: $dark-gray;
    }
    p {
        font-family: $open-sans-light;
        font-size: 0.9rem;
        margin-bottom: 0;
        color: $dark-gray;
    }
    .alert-content {
        display: flex;
        align-items: flex-start;
    }
    .alert-image {
        width: 60px;
        height: 60px;
        margin-right: $space-4;
        img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
    }
</style>