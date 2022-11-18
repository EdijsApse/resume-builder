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
            <button class="btn btn-primary mt-6" @click="isModalVisible = true">Add level</button>
            <transition name="fade">
                <base-modal @close-modal="isModalVisible = false" v-if="isModalVisible">
                    <template #title>Add language level</template>
                    <template>
                        <transition name="fade">
                            <LoadingSpinner v-if="isLoading" />
                        </transition>
                        <form @submit="saveLanguageLevel">
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
                            <button type="submit" class="btn btn-primary mt-8 modal-action" @click="saveLanguageLevel">Save</button>
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
                name: '',
                code: '',
                isLoading: false,
                errors: {},
                isModalVisible: false
            }
        },
        computed: {
            ...mapState('lists', ['language_levels'])
        },
        methods: {
            ...mapActions('lists', ['addLevel']),
            async saveLanguageLevel(event) {
                event.preventDefault();
                this.errors = {};
                this.isLoading = true;
                await this.addLevel({
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