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
                        <transition name="fade">
                            <LoadingSpinner v-if="isLoading" />
                        </transition>
                        <form @submit="saveLanguage">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name" type="text" v-model="name" class="form-control" />
                                <p v-if="errors['name']" class="form-error">{{ errors['name'] }}</p>
                            </div>
                            <div class="form-group">
                                <label for="code">Code</label>
                                <input id="code" type="text" v-model="code" class="form-control" />
                                <p v-if="errors['code']" class="form-error">{{ errors['code'] }}</p>
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
    import { mapState, mapActions } from 'vuex';
    import { FORM_ERROR_STATUS_CODE, mapInputErrors } from '@/helpers.js';

    export default {
        data() {
            return {
                isModalVisible: false,
                name: '',
                code: '',
                errors: {},
                isLoading: false
            }
        },
        computed: {
            ...mapState('lists', ['languages'])
        },
        methods: {
            ...mapActions('lists', ['addLanguage']),
            async saveLanguage(event) {
                event.preventDefault();
                this.errors = {};
                this.isLoading = true;
                await this.addLanguage({
                    name: this.name,
                    code: this.code
                })
                .then(() => {
                    this.isModalVisible = false;
                    this.name = '';
                    this.code = '';
                })
                .catch((error) => {
                    const { response } = error;
                        if (response && response.status === FORM_ERROR_STATUS_CODE) {
                            this.errors = mapInputErrors(response.data.errors);
                        }
                })
                .finally(() => {
                    this.isLoading = false;
                })
            }
        }
    }
</script>