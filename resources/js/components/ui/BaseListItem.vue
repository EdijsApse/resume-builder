<template>
    <div class="single-list-item">
        <i class="fa-sharp fa-solid fa-circle-xmark remove-btn" @click="removeItem"></i>
        <span>
            <slot></slot>
        </span>
    </div>
</template>

<script>
    export default {
        emits: ['remove-item'],
        methods: {
            removeItem() {
                this.$emit('remove-item');
            }
        }
    }
</script>

<style scoped lang="scss">
    @import '@style/_variables.scss';
    .single-list-item {
        position: relative;
        margin: $space-2;
        margin-bottom: 0;
        border: 2px solid $pink;
        background-color: #FFF;
        color: $dark-gray;
        border-radius: 50px;
        font-size: 0.9rem;
        min-width: 60px;
        text-align: center;
        padding: $space-1 $space-4;
        font-family: $open-sans-light;
        .remove-btn {
            position: absolute;
            right: -4px;
            top: -5px;
            color: $dark-gray;
            cursor: pointer;
            font-size: 0.8rem;
        }
    }
</style>