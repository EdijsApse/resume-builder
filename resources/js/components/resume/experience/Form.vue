<template>
    <div class="relative">
        <transition name="fade">
            <LoadingSpinner v-if="isLoading" />
        </transition>
        <form @submit.prevent="save">
            <div class="resume-section-item">
                <div class="form-group">
                    <label for="jobtitle">{{ $t("forms.jobtitle") }}</label>
                    <input
                        id="jobtitle"
                        type="text"
                        class="form-control"
                        v-model="jobtitle"
                    />
                    <p v-if="errors['jobtitle']" class="form-error">
                        {{ errors["jobtitle"] }}
                    </p>
                </div>
                <div class="form-group">
                    <label for="employer">{{ $t("forms.employer") }}</label>
                    <input
                        id="employer"
                        type="text"
                        class="form-control"
                        v-model="employer"
                    />
                    <p v-if="errors['employer']" class="form-error">
                        {{ errors["employer"] }}
                    </p>
                </div>
                <div class="form-group-row">
                    <div class="form-group">
                        <label for="from">{{ $t("forms.date_from") }}</label>
                        <date-picker
                            id="from"
                            v-model="from"
                            type="month"
                            :popup-style="{ top: '100%', left: 0 }"
                            :append-to-body="false"
                            format="MMMM YYYY"
                            valueType="YYYY-MM-DD"
                            input-class="form-control"
                            :disabled-date="disabledDate"
                        ></date-picker>
                        <p v-if="errors['from']" class="form-error">
                            {{ errors["from"] }}
                        </p>
                    </div>
                    <div class="form-group">
                        <label for="to">{{ $t("forms.date_to") }}</label>
                        <date-picker
                            id="to"
                            v-model="to"
                            @change="is_current = 0"
                            :placeholder="
                                is_current == true
                                    ? this.$t('forms.present')
                                    : ''
                            "
                            type="month"
                            :popup-style="{ top: '100%', left: 0 }"
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
                                        id="current-employer"
                                        class="form-check-input"
                                        type="checkbox"
                                        v-model="is_current"
                                        :checked="is_current == true"
                                        @change="clearSelectedToDate"
                                        true-value="1"
                                        false-value="0"
                                    />
                                    <label
                                        class="form-check-label"
                                        for="current-employer"
                                        >{{
                                            $t("forms.currently_work_here")
                                        }}</label
                                    >
                                </div>
                            </template>
                        </date-picker>
                        <p v-if="errors['to']" class="form-error">
                            {{ errors["to"] }}
                        </p>
                        <p v-if="errors['is_current']" class="form-error">
                            {{ errors["is_current"] }}
                        </p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="duties">{{
                        $t("forms.short_list_or_summary_about_your_duties")
                    }}</label>
                    <ul class="experience-form-duties-list">
                        <li v-for="duty in duties" :key="duty">
                            <span>{{ duty }}</span>
                            <i
                                class="fa-regular fa-circle-xmark"
                                @click="removeDuty(duty)"
                            ></i>
                        </li>
                    </ul>
                    <textarea
                        class="form-control duty-textarea"
                        v-model="duty"
                    ></textarea>
                    <button
                        class="btn btn-secondary"
                        type="button"
                        @click="addDuty"
                    >
                        {{ $t("forms.add_duty") }}
                    </button>
                    <p v-if="errors['duties']" class="form-error">
                        {{ errors["duties"] }}
                    </p>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-6">
                {{ $t("forms.save") }}
            </button>
        </form>
    </div>
</template>

<script>
import { mapActions, mapState } from "vuex";
import { FORM_ERROR_STATUS_CODE, mapInputErrors } from "@/helpers.js";

export default {
    data() {
        return {
            isLoading: false,
            jobtitle: "",
            employer: "",
            from: "",
            to: "",
            duties: [],
            is_current: 0,
            duty: "",
            errors: {},
        };
    },
    emits: ["show-list"],
    computed: {
        ...mapState("experience", ["selectedItem"]),
        isUpdating() {
            return this.selectedItem !== null;
        },
    },
    mounted() {
        if (this.isUpdating) {
            this.jobtitle = this.selectedItem.jobtitle;
            this.employer = this.selectedItem.employer;
            this.from = this.selectedItem.from;
            this.to = this.selectedItem.to;
            this.duties = this.selectedItem.duties ?? [];
            this.is_current = this.selectedItem.is_current;
        }
    },
    beforeUnmount() {
        this.clearSelectedItem();
    },
    methods: {
        ...mapActions("experience", [
            "addItem",
            "updateItem",
            "clearSelectedItem",
        ]),
        removeDuty(duty) {
            this.duties = this.duties.filter((singleDuty) => singleDuty !== duty);
        },
        addDuty() {
            if (this.duty.trim()) {
                this.duties.push(this.duty);
                this.duty = "";
            }
        },
        disabledDate(date) {
            return date > new Date();
        },
        clearSelectedToDate() {
            this.to = "";
            this.$refs.dateToDatepicker.closePopup();
        },
        async save() {
            const exp = {
                jobtitle: this.jobtitle,
                employer: this.employer,
                from: this.from,
                to: this.to,
                duties: this.duties,
                is_current: this.is_current,
            };

            this.isLoading = true;
            this.errors = {};

            if (this.isUpdating) {
                await this.updateItem(exp)
                    .then(() => {
                        this.clearSelectedItem();
                        this.$emit("show-list");
                    })
                    .catch((error) => {
                        const { response } = error;
                        if (
                            response &&
                            response.status === FORM_ERROR_STATUS_CODE
                        ) {
                            this.errors = mapInputErrors(response.data.errors);
                        }
                    })
                    .finally(() => {
                        this.isLoading = false;
                    });
            } else {
                await this.addItem(exp)
                    .then(() => {
                        this.$emit("show-list");
                    })
                    .catch((error) => {
                        const { response } = error;
                        if (
                            response &&
                            response.status === FORM_ERROR_STATUS_CODE
                        ) {
                            this.errors = mapInputErrors(response.data.errors);
                        }
                    })
                    .finally(() => {
                        this.isLoading = false;
                    });
            }
        },
    },
};
</script>

<style scoped>
.duty-textarea {
    min-height: 50px;
    margin-bottom: 1rem;
}
</style>
