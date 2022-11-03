<template>
    <div class="single-resume-section-item">
        <div class="actions">
            <i class="fa-solid fa-pencil" @click="$emit('select-item')"></i>
            <i class="fa-solid fa-trash" @click="$emit('delete-item')"></i>
        </div>
        <slot></slot>
    </div>
</template>

<script>
    export default {
        emits: ['select-item', 'delete-item']
    }
</script>

<style lang="scss">
    @import '@style/_variables.scss';
    .single-resume-section-item {
        position: relative;
        background-color: #FFF;
        padding: $space-2;
        border-radius: 5px;
        box-shadow: 0px 0px 3px 0px $bright-gray;
        margin-bottom: $space-4;
        .single-detail {
            margin-bottom: $space-2;
            &:last-of-type {
                margin-bottom: 0;
            }
        }
        h3 {
            font-size: 0.8rem;
            font-family: $open-sans-semibold;
            margin-bottom: 0px;
            i {
                color: $pink;
                font-size: 1rem;
                margin-right: $space-4;
            }
        }
        .actions {
            display: flex;
            position: absolute;
            right: 10px;
            top: 10px;
            i {
                font-size: 1rem;
                color: $pink;
                cursor: pointer;
                margin-left: $space-4;
                &:first-of-type {
                    margin-left: 0;
                }
            }
        }
    }
</style>