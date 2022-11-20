<template>
    <ul class="features-list">
        <li>
            <div class="icon">
                <i class="fa-solid fa-pencil"></i>
            </div>
            <p>{{ $t('general.home_page.feature_1') }}</p>
        </li>
        <li>
            <div class="icon">
                <i class="fa-solid fa-clipboard-list"></i>
            </div>
            <p>{{ $t('general.home_page.feature_2') }}</p>
        </li>
        <li>
            <div class="icon">
                <i class="fa-solid fa-eye"></i>
            </div>
            <p>{{ $t('general.home_page.feature_3') }}</p>
        </li>
        <li>
            <div class="icon">
                <i class="fa-solid fa-circle-down"></i>
            </div>
            <p>{{ $t('general.home_page.feature_4') }}</p>
        </li>
    </ul>
</template>

<script></script>

<style scoped lang="scss">
    @import '@style/_variables.scss';
    @import '@style/_mixins.scss';
    .features-list {
        display: grid;
        grid-template-columns: 50% 50%;
        column-gap: $space-8;
        list-style: none;
        padding: 0;
        margin: 0;
        color: #FFF;
        max-width: 800px;
        @media (max-width: $screen-md) {
            display: block;
        }
        li {
            padding: 0;
            margin: 0;
            display: flex;
            align-items: center;
            margin-bottom: $space-6;
            @media (max-width: $screen-sm) {
                margin-bottom: $space-4;
            }
            .icon {
                margin-right: $space-6;
                background-color: $pink;
                @include fixed-rounded-container(3rem);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.2rem;
                @media (max-width: $screen-sm) {
                    @include fixed-rounded-container(2.5rem);
                    font-size: 1rem;
                    margin-right: $space-4;
                }
            }
            p {
                margin: 0;
                font-size: 1.2rem;
                @media (max-width: $screen-lg) {
                    font-size: 1rem;
                }
                @media (max-width: $screen-sm) {
                    font-size: 0.9rem;
                }
            }
        }
    }
</style>