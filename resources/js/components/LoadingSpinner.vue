<template>
    <div class="spinner-wrapper" ref="spinner">
        <div class="spinner-grow"></div>
        <slot></slot>
    </div>
</template>

<style scoped lang="scss">
    @import '@style/_variables.scss';
    .spinner-wrapper {
        position: absolute;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(#FFF, 0.45);
        z-index: 1;
    }
    .spinner-grow {
        min-height: 2rem;
        animation-duration: 0.7s;
        color: $pink;
    }
</style>