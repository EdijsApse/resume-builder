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
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="language in languages" :key="language.id">
                        <td>{{ language.id }}</td>
                        <td>{{ language.name }}</td>
                        <td>{{ language.code }}</td>
                    </tr>
                </tbody>
            </table>
            <button class="btn btn-primary mt-6" @click="isModalVisible = true">Add language</button>
            <transition name="fade">
                <base-modal @close-modal="isModalVisible = false" v-if="isModalVisible">
                    <template #title>Add language</template>
                    <template>
                        <form @submit="saveLanguage">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name" type="text" v-model="name" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="code">Code</label>
                                <input id="code" type="text" v-model="code" class="form-control" />
                            </div>
                            <button type="submit" class="btn btn-primary mt-8 modal-action" @click="saveLanguage">Save</button>
                        </form>
                    </template>
                </base-modal>
            </transition>
        </template>
    </base-admin-page>
</template>

<script>
    import { mapState } from 'vuex';
    
    export default {
        data() {
            return {
                isModalVisible: false,
                name: '',
                code: ''
            }
        },
        computed: {
            ...mapState('lists', ['languages'])
        },
        methods: {
            saveLanguage(event) {
                event.preventDefault();
                this.isModalVisible = false;
            },
            showModal() {
                this.isModalVisible = true;
            }
        }
    }
</script>