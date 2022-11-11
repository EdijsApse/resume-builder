<template>
    <div class="single-resume-section-item">
        <div class="actions">
            <i class="fa-solid fa-pencil" @click="$emit('select-item')"></i>
            <i class="fa-solid fa-trash remove-item" @click="$emit('delete-item')"></i>
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
        padding: $space-4;
        border-radius: 5px;
        box-shadow: 0px 0px 3px 0px $bright-gray;
        margin-bottom: $space-4;
        .single-detail {
            margin-bottom: $space-2;
            &:last-of-type {
                margin-bottom: 0;
            }
        }
        .secondary-detail {
            h3 {
                font-size: 0.9rem;
                color: $darkish-gray;
            }
        }
        h3 {
            font-size: 1.1rem;
            font-family: $open-sans-regular;
            margin-bottom: 0px;
        }
        .actions {
            display: flex;
            flex-direction: column;
            position: absolute;
            right: 15px;
            top: 15px;
            i {
                font-size: 1rem;
                color: $darkish-gray;
                cursor: pointer;
                transition: all 0.3s;
                &:hover {
                    color: $pink;
                }
            }
            .remove-item {
                margin-top: $space-4;
            }
        }
    }
</style>