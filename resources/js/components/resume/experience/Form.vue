<template>
    <div class="relative">
        <transition name="fade">
            <LoadingSpinner v-if="isLoading" />
        </transition>
        <form @submit.prevent="save">
            <div class="resume-section-item">
                <div class="form-group">
                    <label for="jobtitle">Jobtitle</label>
                    <input id="jobtitle" type="text" class="form-control" v-model="jobtitle" />
                    <p v-if="errors['jobtitle']" class="form-error">{{ errors['jobtitle'] }}</p>
                </div>
                <div class="form-group">
                    <label for="employer">Employer</label>
                    <input id="employer" type="text" class="form-control" v-model="employer" />
                    <p v-if="errors['employer']" class="form-error">{{ errors['employer'] }}</p>
                </div>
                <div class="form-group-row">
                    <div class="form-group">
                        <label for="from">Date from</label>
                        <date-picker
                            id="from"
                            v-model="from"
                            type="month"
                            :popup-style="{ top: '100%', left: 0}"
                            :append-to-body="false"
                            format="MMMM YYYY"
                            valueType="YYYY-MM-DD"
                            input-class="form-control"
                        ></date-picker>
                        <p v-if="errors['from']" class="form-error">{{ errors['from'] }}</p>
                    </div>
                    <div class="form-group">
                        <label for="to">Date to</label>
                        <date-picker
                            id="to"
                            v-model="to"
                            @change="is_current = 0"
                            :placeholder="is_current == true ? 'Current work' : ''"
                            type="month"
                            :popup-style="{ top: '100%', left: 0}"
                            :append-to-body="false"
                            format="MMMM YYYY"
                            valueType="YYYY-MM-DD"
                            input-class="form-control placeholder-dark"
                            ref="dateToDatepicker"
                        >
                            <template #footer>
                                <div class="current-employer">
                                    <div class="form-check form-switch">
                                        <input
                                            id="current-employer"
                                            class="form-check-input"
                                            type="checkbox"
                                            v-model="is_current"
                                            :checked="is_current == true"
                                            @change="clearSelectedToDate"
                                            true-value="1"
                                            false-value="0"
                                        >
                                        <label class="form-check-label" for="current-employer">Currently work here</label>
                                    </div>
                                </div>
                            </template>
                        </date-picker>
                        <p v-if="errors['to']" class="form-error">{{ errors['to'] }}</p>
                        <p v-if="errors['is_current']" class="form-error">{{ errors['is_current'] }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="duties">Short list or summary about your duties</label>
                    <textarea class="form-control" v-model="duties"></textarea>
                    <p v-if="errors['duties']" class="form-error">{{ errors['duties'] }}</p>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-6">Save</button>
        </form>
    </div>
</template>

<script>
    import { mapActions, mapState } from 'vuex';
    import { FORM_ERROR_STATUS_CODE, mapInputErrors } from '@/helpers.js';

    export default {
        data() {
            return {
                isLoading: false,
                jobtitle: '',
                employer: '',
                from: '',
                to: '',
                duties: '',
                is_current: 0,
                errors: {}
            }
        },
        emits: ['show-list'],
        computed: {
            ...mapState('experience', ['selectedItem']),
            isUpdating() {
                return this.selectedItem !== null;
            }
        },
        mounted() {
            if(this.isUpdating) {
                this.jobtitle = this.selectedItem.jobtitle;
                this.employer = this.selectedItem.employer;
                this.from = this.selectedItem.from;
                this.to = this.selectedItem.to;
                this.duties = this.selectedItem.duties;
                this.is_current = this.selectedItem.is_current;
            }
        },
        beforeUnmount() {
            this.clearSelectedItem();
        },
        methods: {
            ...mapActions('experience', ['addItem', 'updateItem', 'clearSelectedItem']),
            clearSelectedToDate() {
                this.to = '';
                this.$refs.dateToDatepicker.closePopup();
                console.log(this.is_current)
            },
            async save() {
                const exp = {
                    jobtitle: this.jobtitle,
                    employer: this.employer,
                    from: this.from,
                    to: this.to,
                    duties: this.duties,
                    is_current: this.is_current
                }

                this.isLoading = true;
                this.errors = {};

                if (this.isUpdating) {
                    await this.updateItem(exp).then(() => {
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
                    await this.addItem(exp).then(() => {
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