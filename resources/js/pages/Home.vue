<template>
    <div class="intro-wrapper">
        <div class="container intro">
            <div class="intro-content">
                <h1><span class="pink">{{ $t('general.home_page.create') }}</span> {{ $t('general.home_page.your') }} <br/> <span class="pink">{{ $t('general.home_page.professional') }}</span> {{ $t('general.home_page.resume') }}</h1>
                <HomeFeatureList />
                <router-link to="/create" class="btn btn-primary">{{ $t('resume.create_resume') }}</router-link>
            </div>
        </div>
    </div>
</template>

<script>
    import HomeFeatureList from '@/components/HomeFeatureList.vue';
    export default {
        components: {
            HomeFeatureList        
        }
    }
</script>

<style lang="scss" scoped>
    @import '@style/_variables.scss';
    .intro-wrapper {
        position: relative;
        display: flex;
        justify-content: flex-start;
        align-items: center;
        min-height: 100vh;
        background-image: url('/images/bg5.png');
        background-size: cover;
        @media(max-width: $screen-lg) {
            padding-top: 66px;
            padding-bottom: 66px;
        }
    }
    .intro-content {
        .btn {
            display: inline-block;
            margin-top: $space-8;
            width: auto;
            @media (max-width: $screen-lg) {
                margin-top: $space-2;
            }
            @media (max-width: $screen-md) {
                width: 100%;
            }
            @media (max-width: $screen-sm) {
                margin-top: $space-6;
            }
        }
    }
    h1 {
        font-size: 5.1rem;
        color: #FFF;
        font-weight: bold;
        margin-bottom: 3rem;
        @media (max-width: $screen-lg) {
            font-size: 3.1rem;
            margin-bottom: $space-6;
        }
        @media (max-width: $screen-sm) {
            font-size: 2.6rem;
            margin-bottom: $space-8;
        }
    }
    .pink {
        color: $pink;
        text-transform: capitalize;
    }
</style>