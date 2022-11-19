<template>
    <div class="relative">
        <transition name="fade">
            <LoadingSpinner v-if="isLoading" />
        </transition>
        <form @submit.prevent="save">
            <div class="resume-section-item">
                <div class="form-group">
                    <label for="name">{{ $t('forms.name_of_certificate') }}</label>
                    <input id="name" type="text" class="form-control" v-model="name" />
                    <p v-if="errors['name']" class="form-error">{{ errors['name'] }}</p>
                </div>
                <div class="form-group-row">
                    <div class="form-group">
                        <label for="organization">{{ $t('forms.issuing_organization') }}</label>
                        <input id="organization" type="text" class="form-control" v-model="organization" />
                        <p v-if="errors['organization']" class="form-error">{{ errors['organization'] }}</p>
                    </div>
                    <div class="form-group">
                        <label for="issued">{{ $t('forms.issued') }}</label>
                        <date-picker
                            id="issued"
                            v-model="issued"
                            type="month"
                            :popup-style="{ top: '100%', left: 0}"
                            :append-to-body="false"
                            format="MMMM YYYY"
                            valueType="YYYY-MM-DD"
                            input-class="form-control"
                            :disabled-date="disabledDate"
                        ></date-picker>
                        <p v-if="errors['issued']" class="form-error">{{ errors['issued'] }}</p>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-6">{{ $t('forms.save') }}</button>
        </form>
    </div>
</template>

<script>
    import { mapActions, mapState } from 'vuex';
    import { FORM_ERROR_STATUS_CODE, mapInputErrors } from '@/helpers.js';

    export default {
        data() {
            return {
                name: '',
                organization: '',
                issued: '',
                errors: {},
                isLoading: false
            }
        },
        emits: ['show-list'],
        computed: {
            ...mapState('certificate', ['selectedItem']),
            isUpdating() {
                return this.selectedItem !== null;
            }
        },
        mounted() {
            if(this.isUpdating) {
                this.name = this.selectedItem.name;
                this.organization = this.selectedItem.organization;
                this.issued = this.selectedItem.issued;
            }
        },
        beforeUnmount() {
            this.clearSelectedItem();
        },
        methods: {
            ...mapActions('certificate', ['addItem', 'updateItem', 'clearSelectedItem']),
            disabledDate(date) {
                return date > new Date();
            },
            async save() {
                const cert = {
                    name: this.name,
                    organization: this.organization,
                    issued: this.issued
                };

                this.isLoading = true;
                this.errors = {};

                if (this.isUpdating) {
                    await this.updateItem(cert).then(() => {
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
                    await this.addItem(cert).then(() => {
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