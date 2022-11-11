<template>
    <div class="resume-section-header">
        <h2><slot></slot></h2>
        <Transition name="fade" mode="out-in">
            <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 50 50" width="30px" height="30px" v-if="isCloseButtonVisible" @click="$emit('close-form')">
                <path d="M 7.71875 6.28125 L 6.28125 7.71875 L 23.5625 25 L 6.28125 42.28125 L 7.71875 43.71875 L 25 26.4375 L 42.28125 43.71875 L 43.71875 42.28125 L 26.4375 25 L 43.71875 7.71875 L 42.28125 6.28125 L 25 23.5625 Z"/>
            </svg>
        </Transition>
    </div>
</template>

<script>
    export default {
        props: ['isCloseButtonVisible'],
        emits: ['close-form']
    }
</script>

<style scoped lang="scss">
    @import '@style/_variables.scss';
    .resume-section-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: $space-4;
        svg {
            width: 30px;
            color: $dark-gray;
            cursor: pointer;
            &:hover {
                path {
                    fill: $pink;
                }
            }
            path {
                fill: $dark-gray;
                transition: all 0.3s;
            }
        }
    }
    h2 {
        font-family: $open-sans-light;
        font-size: 1.6rem;
        margin-bottom: 0;
        color: $dark-gray;
        &::after {
            display: block;
            width: 60px;
            background-color: $pink;
            height: 2px;
            content: "";
            margin-top: $space-2;
        }
    }
</style>