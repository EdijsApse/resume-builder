<template>
    <base-container>
        <template #header>
            <slot name="header"></slot>
        </template>
        <template name="default">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-3 mobile-fixed-sidebar" ref="sidebar">
                        <div class="close-icon" @click="$refs.sidebar.classList.remove('visible')">
                            <i class="fa-solid fa-xmark"></i>
                        </div>
                        <AdminSidebar />
                    </div>
                    <div class="col-12 col-lg-9">
                        <div class="admin-table-wrapper">
                            <slot></slot>
                        </div>
                    </div>
                </div>
                <div class="sidebar-toggler" @click="$refs.sidebar.classList.add('visible')">
                    <i class="fa-solid fa-list"></i>
                </div>
            </div>
        </template>
    </base-container>
</template>

<script>
    import AdminSidebar from '@components/admin/Sidebar.vue';
    export default {
        components: {
            AdminSidebar
        },
        watch: {
            '$route': function() {
                this.$refs.sidebar.classList.remove('visible')
            }
        }
    }
</script>

<style lang="scss" scoped>
    .container {
        margin-top: 4rem;
        margin-bottom: 4rem;
    }
    .admin-table-wrapper {
        max-width: 800px;
        margin: auto;
    }
</style>