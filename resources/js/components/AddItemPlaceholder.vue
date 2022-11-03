<template>
    <div class="add-item-placeholder" @click="$emit('add-item')">
        <i class="fa-solid fa-circle-plus"></i>
        <p>Add more</p>
    </div>
</template>

<script>
    export default {
        emits: ['add-item']
    }
</script>

<style scoped lang="scss">
    @import '@style/_variables.scss';
    .add-item-placeholder {
        display: flex;
        align-items: center;
        padding: $space-2 $space-2;
        border-radius: 5px;
        border: 2px dashed rgba($pink, 0.3);
        margin-top: $space-4;
        cursor: pointer;
        transition: all 0.3s;
        &:hover {
            background-color: #FFF;
            border-color: $pink;
        }
        p {
            font-family: $open-sans-semibold;
            font-size: 1rem;
            margin-bottom: 0;
            color: $dark-gray;
        }
        i {
            margin-right: $space-2;
            color: $pink;
            font-size: 1.2rem;
        }
    }
</style>