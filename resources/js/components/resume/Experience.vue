<template>
    <div class="resume-section-wrapper relative">
        <transition name="fade">
            <LoadingSpinner v-if="isLoading" />
        </transition>
        <base-resume-section-header @close-form="closeForm" :isCloseButtonVisible="!isListVisible">{{ $t('resume.work_experience') }}</base-resume-section-header>
        <Transition name="fade" mode="out-in">
            <div v-if="isListVisible" class="mt-8">
                <ExperienceItem
                    v-for="experience in items"
                    :key="experience.id"
                    :experience="experience"
                    @edit-experience="selectExperienceForUpdate"
                    @delete-experience="deleteExperience"
                />
                <AddItemPlaceholder @add-item="isListVisible = false" />
                <button class="btn btn-primary" @click="navigateToNextStep">{{ $t('resume.next') }}</button>
            </div>
            <ExperienceForm v-else @show-list="isListVisible = true" />
        </Transition>
    </div>
</template>

<script>
    import ExperienceForm from '@components/resume/experience/Form.vue'
    import ExperienceItem from '@components/resume/experience/Item.vue'
    import AddItemPlaceholder from '@components/AddItemPlaceholder.vue'
    import { mapState, mapActions } from 'vuex'

    export default {
        data() {
            return {
                nextStep: 'Education',
                isLoading: false,
                isListVisible: true
            }
        },
        computed: {
            ...mapState('experience', ['items'])
        },
        methods: {
            ...mapActions('experience', ['loadItems', 'selectItem', 'clearSelectedItem', 'deleteItem']),
            async loadExperiences() {
                this.isLoading = true;
                await this.loadItems().finally(() => {
                    this.isLoading = false;
                })
            },
            async deleteExperience(id) {
                this.isLoading = true;
                await this.deleteItem(id).finally(() => {
                    this.isLoading = false;
                });
            },
            selectExperienceForUpdate(id) {
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
            this.loadExperiences();
        },
        components: {
            ExperienceForm,
            ExperienceItem,
            AddItemPlaceholder
        }
    }
</script>