<template>
    <div class="intro-wrapper">
        <div class="container intro">
            <div class="intro-content">
                <h1><span class="pink">Create</span> your <br/> <span class="pink">professional</span> resume</h1>
                <HomeFeatureList />
                <router-link to="/create" class="btn btn-primary">Create resume</router-link>
            </div>
            <div class="intro-form-wrapper">
                <HomeForm />
            </div>
        </div>
    </div>
</template>

<script setup>
    import HomeForm from '@/components/HomeForm.vue';
    import HomeFeatureList from '@/components/HomeFeatureList.vue';
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
    }
    .btn {
        display: inline-block;
    }
    .intro-form-wrapper {
        margin-left: auto;
    }
    .intro {
        display: grid;
        grid-template-columns: 70% 30%;
        width: 100%;
    }
    .intro-content {
        .btn {
            margin-top: $space-8;
            width: auto;
        }
    }
    h1 {
        font-size: 5.1rem;
        color: #FFF;
        font-weight: bold;
        margin-bottom: 3rem;
    }
    .pink {
        color: $pink;
        text-transform: capitalize;
    }
</style>