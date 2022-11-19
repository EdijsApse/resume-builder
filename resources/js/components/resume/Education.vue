<template>
    <div class="resume-section-wrapper relative">
        <transition name="fade">
            <LoadingSpinner v-if="isLoading" />
        </transition>
        <base-resume-section-header @close-form="closeForm" :isCloseButtonVisible="!isListVisible">{{ $t('resume.education') }}</base-resume-section-header>
        <Transition name="fade" mode="out-in">
            <div v-if="isListVisible" class="mt-8">
                <EducationItem
                    v-for="education in items"
                    :key="education.id"
                    :education="education"
                    @edit-education="selectEducationForUpdate"
                    @delete-education="deleteEducation"
                />
                <AddItemPlaceholder @add-item="isListVisible = false" />
                <button class="btn btn-primary" @click="navigateToNextStep">{{ $t('resume.next') }}</button>
            </div>
            <EducationForm v-else @show-list="isListVisible = true" />
        </Transition>
    </div>
</template>

<script>
    import EducationForm from '@components/resume/education/Form.vue'
    import EducationItem from '@components/resume/education/Item.vue'
    import AddItemPlaceholder from '@components/AddItemPlaceholder.vue'
    import { mapActions, mapState } from 'vuex';

    export default {
        data() {
            return {
                nextStep: 'Certificate',
                isLoading: false,
                isListVisible: true
            }
        },
        computed: {
            ...mapState('education', ['items'])
        },
        methods: {
            ...mapActions('education', ['loadItems', 'selectItem', 'clearSelectedItem', 'deleteItem']),
            async loadEducations() {
                this.isLoading = true;
                await this.loadItems().finally(() => {
                    this.isLoading = false;
                })
            },
            async deleteEducation(id) {
                this.isLoading = true;
                await this.deleteItem(id).finally(() => {
                    this.isLoading = false;
                });
            },
            selectEducationForUpdate(id) {
                this.selectItem(id);
                this.isListVisible = false;
            },
            navigateToNextStep() {
                this.$emit('next-step', this.nextStep);
            },
            closeForm() {
                this.isListVisible = true;
                this.clearSelectedItem();
            }
        },
        mounted() {
            this.loadEducations();
        },
        components: {
            EducationForm,
            EducationItem,
            AddItemPlaceholder
        }
    }
</script>