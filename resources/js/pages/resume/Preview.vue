<template>
    <base-container>
        <template #header>Preview resume</template>
        <template #default>
            <div class="container resume-preview-container">
                <div class="row justify-content-center">
                    <div class="col-9 max-793">
                        <Layout1 slot="pdf-content" />
                    </div>
                </div>
                <div class="download-btn-wrapper">
                    <button class="btn btn-primary">Download</button>
                </div>
            </div>
        </template>
    </base-container>
</template>

<script>
    import Layout1 from '@components/layouts/Layout-1.vue';
 
    export default {
        components: {
            Layout1
        }
    }
</script>

<style scoped lang="scss">
    @import '@style/_variables.scss';
    .resume-preview-container {
        margin-top: $space-8;
        margin-bottom: $space-8;
        .max-793 {
            max-width: 793px;
            border: 1px solid $bright-gray;
            background-color: #FFF;
        }
        .download-btn-wrapper {
            max-width: 793px;
            margin-left: auto;
            margin-right: auto;
            margin-top: $space-8;
        }
    }
</style>