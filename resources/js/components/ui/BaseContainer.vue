<template>
    <div class="page">
        <div class="page-header">
            <div class="container">
                <h1>
                    <slot name="header"></slot>
                </h1>
            </div>
        </div>
        <slot></slot>
    </div>
</template>
<style scoped lang="scss">
    @import '@style/_variables.scss';

    .page-header {
        background-image: url('/images/bg5.png');
        background-position: center;
        background-size: cover;
        padding-bottom: $space-4;
        padding-top: calc($space-4 + 78.05px);
    }
    h1 {
        font-family: $titilium-regular;
        font-size: 2.5rem;
        color: #FFF;
    }
</style>