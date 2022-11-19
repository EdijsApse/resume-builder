<template>
    <div class="add-item-placeholder" @click="$emit('add-item')">
        <i class="fa-solid fa-circle-plus"></i>
        <p>{{ $t('forms.add_more') }}</p>
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
        border: 2px dashed rgba($pink, 0.4);
        margin-top: $space-4;
        height: 74px;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s;
        &:hover {
            background-color: #FFF;
            border-color: $pink;
            p {
                opacity: 1;
            }
            i {
                opacity: 1;
            }
        }
        p {
            position: relative;
            top: 1px;
            font-size: 1.1rem;
            margin-bottom: 0;
            color: $dark-gray;
            opacity: 0.7;
            transition: all 0.3s;
        }
        i {
            margin-right: $space-2;
            color: $pink;
            font-size: 1.5rem;
            opacity: 0.4;
            transition: all 0.3s;
        }
    }
</style>