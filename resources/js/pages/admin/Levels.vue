<template>
    <base-admin-page>
        <template #header>Language levels</template>
        <template>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Code</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="level in language_levels" :key="level.id">
                        <td>{{ level.id }}</td>
                        <td>{{ level.name }}</td>
                        <td>{{ level.code }}</td>
                    </tr>
                </tbody>
            </table>
            <button class="btn btn-primary mt-6">Add level</button>
        </template>
    </base-admin-page>
</template>

<script>
    import { mapState } from 'vuex';
    
    export default {
        computed: {
            ...mapState('lists', ['language_levels'])
        }    
    }
</script>