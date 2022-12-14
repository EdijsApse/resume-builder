<template>
    <div class="relative">
        <transition name="fade">
            <LoadingSpinner v-if="isLoading" />
        </transition>
        <form @submit.prevent="save">
            <div class="resume-section-item">
                <div class="form-group">
                    <label for="language">{{ $t('forms.language') }}</label>
                    <v-select
                        v-model="language_id"
                        id="language"
                        :reduce="(option) => option.value"
                        :options="languages"
                    ></v-select>
                    <p v-if="errors['language_id']" class="form-error">{{ errors['language_id'] }}</p>
                </div>
                <div class="form-group">
                    <label for="level">{{ $t('forms.level') }}</label>
                    <v-select
                        v-model="level_id"
                        id="level"
                        :reduce="(option) => option.value"
                        :options="language_levels"
                    ></v-select>
                    <p v-if="errors['level_id']" class="form-error">{{ errors['level_id'] }}</p>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-6">{{ $t('forms.save') }}</button>
        </form>
    </div>
</template>

<script>
    import { mapActions, mapState, mapGetters } from 'vuex';
    import { FORM_ERROR_STATUS_CODE, mapInputErrors } from '@/helpers.js';

    export default {
        data() {
            return {
                isLoading: false,
                errors: {},
                language_id: '',
                level_id: ''
            }
        },
        emits: ['show-list'],
        computed: {
            ...mapState('language', ['selectedItem']),
            ...mapGetters('lists', ['languagesForSelect', 'levelsForSelect']),
            isUpdating() {
                return this.selectedItem !== null;
            }
        },
        mounted() {
            if(this.isUpdating) {
                this.language_id = this.selectedItem.language_id;
                this.level_id = this.selectedItem.level_id;
            }
        },
        beforeUnmount() {
            this.clearSelectedItem();
        },
        methods: {
            ...mapActions('language', ['addItem', 'updateItem', 'clearSelectedItem']),
            async save() {
                const lang = {
                    language_id: this.language_id,
                    level_id: this.level_id,
                }

                this.isLoading = true;
                this.errors = {};

                if (this.isUpdating) {
                    await this.updateItem(lang).then(() => {
                        this.clearSelectedItem();
                        this.$emit('show-list');
                    })
                    .catch((error) => {
                        const { response } = error;
                        if (response && response.status === FORM_ERROR_STATUS_CODE) {
                            this.errors = mapInputErrors(response.data.errors);
                        }
                    }).finally(() => {
                        this.isLoading = false;
                    })
                } else {
                    await this.addItem(lang).then(() => {
                        this.$emit('show-list');
                    }).catch((error) => {
                        const { response } = error;
                        if (response && response.status === FORM_ERROR_STATUS_CODE) {
                            this.errors = mapInputErrors(response.data.errors);
                        }
                    }).finally(() => {
                        this.isLoading = false;
                    })
                }
            }
        }
    }
</script>