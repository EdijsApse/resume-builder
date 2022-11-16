<template>
    <base-admin-page>
        <template #header>Languages</template>
        <template>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Code</th>
                        <th scope="col" class="action-cell"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="language in languages" :key="language.id">
                        <td>{{ language.id }}</td>
                        <td>{{ language.name }}</td>
                        <td>{{ language.code }}</td>
                        <td class="action-cell">
                            <button class="btn btn-secondary btn-sm w-100">Edit</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <button class="btn btn-primary mt-6">Add language</button>
        </template>
    </base-admin-page>
</template>

<script>
    import { mapState } from 'vuex';
    
    export default {
        computed: {
            ...mapState('lists', ['languages'])
        }    
    }
</script>