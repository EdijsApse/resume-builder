<template>
    <div class="modal" @click="$emit('close-modal')">
        <div class="modal-dialog">
            <div class="modal-content relative" @click.stop>
                <div class="modal-header">
                    <h2 class="modal-title">
                        <slot name="title"></slot>
                    </h2>
                </div>
                <div class="modal-body">
                    <slot></slot>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        emits: ['close-modal']   
    }
</script>

<style lang="scss" scoped>
    @import '@style/_variables.scss';
    .modal {
        display: block;
        background-color: rgba(0, 0, 0, 0.7);
    }
    .modal-dialog {
        margin-top: 100px;
        max-width: 750px;
        animation: slide-down 0.3s forwards;
    }
    .modal-header {
        padding: 0;
        border: none;
        .modal-title {
            margin: 0;
            &::after {
                display: block;
                content: "";
                width: 100px;
                height: 2px;
                background-color: $pink;
                margin-top: $space-2;
                margin-bottom: $space-6;
            }
        }
    }
    .modal-body {
        padding: 0;
    }
    .modal-content {
        padding: $space-8;
        padding-top: $space-6;
    }
    .modal-action {
        width: 150px;
    }
    @keyframes slide-down {
        from {
            opacity: 0;
            transform: translateY(-60px);
        }
        to {
            opacity: 1;
            transform: translateY(0px);
        }
    }
</style>