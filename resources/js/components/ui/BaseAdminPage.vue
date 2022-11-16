<template>
    <base-container>
        <template #header>
            <slot name="header"></slot>
        </template>
        <template name="default">
            <div class="container">
                <div class="row">
                    <div class="col-3">
                        <AdminSidebar />
                    </div>
                    <div class="col-9">
                        <div class="admin-table-wrapper">
                            <slot></slot>
                        </div>
                    </div>
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