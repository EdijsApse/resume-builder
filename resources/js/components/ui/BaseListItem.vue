<template>
    <div class="single-list-item" @click="$emit('item-clicked')">
        <i v-if="canRemove" class="fa-sharp fa-solid fa-circle-xmark remove-btn" @click.stop="removeItem"></i>
        <slot></slot>
    </div>
</template>

<script>
    export default {
        emits: ['remove-item', 'item-clicked'],
        props: {
            canRemove: {
                default: true
            }
        },
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
        margin: $space-1;
        font-family: $open-sans-semibold;
        background-color: $brightish-gray;
        color: $darkish-gray;
        padding: $space-2 $space-4;
        border-radius: 50px;
        font-size: 0.8rem;
        cursor: pointer;
        transition: all 0.3s;
        &:hover {
            background-color: rgba($pink, 0.1);
            color: $pink;
        }
        .remove-btn {
            position: absolute;
            top: 0;
            right: 0;
        }
        .fa-plus {
            position: relative;
            top: 1px;
            margin-left: $space-2;
        }
    }
</style>