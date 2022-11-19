<template>
    <div class="relative">
        <transition name="fade">
            <LoadingSpinner v-if="isLoading" />
        </transition>
        <form @submit.prevent="save">
            <div class="resume-section-item">
                <div class="form-group-row">
                    <div class="form-group">
                        <label for="school">{{ $t('forms.name_of_school') }}</label>
                        <input id="school" type="text" class="form-control" v-model="school" />
                        <p v-if="errors['school']" class="form-error">{{ errors['school'] }}</p>
                    </div>
                    <div class="form-group">
                        <label for="degree">{{ $t('forms.degree') }}</label>
                        <input id="degree" type="text" class="form-control" v-model="degree" />
                        <p v-if="errors['degree']" class="form-error">{{ errors['degree'] }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="field">{{ $t('forms.field') }}</label>
                    <input id="field" type="text" class="form-control" v-model="field" />
                    <p v-if="errors['field']" class="form-error">{{ errors['field'] }}</p>
                </div>
                <div class="form-group-row">
                    <div class="form-group">
                        <label for="from">{{ $t('forms.date_from') }}</label>
                        <date-picker
                            id="from"
                            v-model="from"
                            type="month"
                            :popup-style="{ top: '100%', left: 0}"
                            :append-to-body="false"
                            format="MMMM YYYY"
                            valueType="YYYY-MM-DD"
                            input-class="form-control"
                            :disabled-date="disabledDate"
                        ></date-picker>
                        <p v-if="errors['from']" class="form-error">{{ errors['from'] }}</p>
                    </div>
                    <div class="form-group">
                        <label for="to">{{ $t('forms.date_to') }}</label>
                        <date-picker
                            id="to"
                            v-model="to"
                            @change="is_current = 0"
                            :placeholder="is_current == true ? this.$t('forms.present') : ''"
                            type="month"
                            :popup-style="{ top: '100%', left: 0}"
                            :append-to-body="false"
                            format="MMMM YYYY"
                            valueType="YYYY-MM-DD"
                            input-class="form-control placeholder-dark"
                            :disabled-date="disabledDate"
                            ref="dateToDatepicker"
                        >
                            <template #footer>
                                <div class="form-check form-switch">
                                    <input
                                        id="current-school"
                                        class="form-check-input"
                                        type="checkbox"
                                        v-model="is_current"
                                        :checked="is_current == true"
                                        @change="clearSelectedToDate"
                                        true-value="1"
                                        false-value="0"
                                    >
                                    <label class="form-check-label" for="current-school">{{ $t('forms.currently_study_here') }}</label>
                                </div>
                            </template>
                        </date-picker>
                        <p v-if="errors['to']" class="form-error">{{ errors['to'] }}</p>
                        <p v-if="errors['is_current']" class="form-error">{{ errors['is_current'] }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="summary">{{ $t('forms.short_summary') }}</label>
                    <textarea class="form-control" v-model="summary"></textarea>
                    <p v-if="errors['summary']" class="form-error">{{ errors['summary'] }}</p>
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
                degree: '',
                school: '',
                field: '',
                from: '',
                to: '',
                summary: '',
                is_current: 0,
                errors: {},
                isLoading: false
            }
        },
        emits: ['show-list'],
        computed: {
            ...mapState('education', ['selectedItem']),
            isUpdating() {
                return this.selectedItem !== null;
            }
        },
        mounted() {
            if(this.isUpdating) {
                this.degree = this.selectedItem.degree;
                this.school = this.selectedItem.school;
                this.field = this.selectedItem.field;
                this.from = this.selectedItem.from;
                this.to = this.selectedItem.to;
                this.summary = this.selectedItem.summary;
                this.is_current = this.selectedItem.is_current; 
            }
        },
        beforeUnmount() {
            this.clearSelectedItem();
        },
        methods: {
            ...mapActions('education', ['addItem', 'updateItem', 'clearSelectedItem']),
            disabledDate(date) {
                return date > new Date();
            },
            clearSelectedToDate() {
                this.to = '';
                this.$refs.dateToDatepicker.closePopup();
            },
            async save() {
                const edu = {
                    degree: this.degree,
                    school: this.school,
                    field: this.field,
                    from: this.from,
                    to: this.to,
                    summary: this.summary,
                    is_current: this.is_current
                };

                this.isLoading = true;
                this.errors = {};

                if (this.isUpdating) {
                    await this.updateItem(edu).then(() => {
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
                    await this.addItem(edu).then(() => {
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