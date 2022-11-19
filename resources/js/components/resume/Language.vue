<template>
    <div class="resume-section-wrapper relative">
        <transition name="fade">
            <LoadingSpinner v-if="isLoading" />
        </transition>
        <base-resume-section-header @close-form="closeForm" :isCloseButtonVisible="!isListVisible">{{ $t('admin.languages') }}</base-resume-section-header>
        <Transition name="fade" mode="out-in">
            <div v-if="isListVisible" class="mt-8">
                <LanguageItem
                    v-for="language in items"
                    :key="language.id"
                    :language="language"
                    @edit-language="selectLanguageForUpdate"
                    @delete-language="deleteLanguage"
                />
                <AddItemPlaceholder @add-item="isListVisible = false" />
                <button class="btn btn-primary" @click="navigateToNextStep">{{ $t('resume.next') }}</button>
            </div>
            <LanguageForm v-else @show-list="isListVisible = true" />
        </Transition>
    </div>
</template>

<script>
    import LanguageForm from '@components/resume/language/Form.vue'
    import LanguageItem from '@components/resume/language/Item.vue'
    import AddItemPlaceholder from '@components/AddItemPlaceholder.vue'
    import { mapActions, mapState } from 'vuex'

    export default {
        data() {
            return {
                nextStep: 'Skill',
                isLoading: false,
                isListVisible: true
            }
        },
        computed: {
            ...mapState('language', ['items'])
        },
        methods: {
            ...mapActions('language', ['loadItems', 'selectItem', 'clearSelectedItem', 'deleteItem']),
            async loadLanguages() {
                this.isLoading = true;
                await this.loadItems().finally(() => {
                    this.isLoading = false;
                })
            },
            async deleteLanguage(id) {
                this.isLoading = true;
                await this.deleteItem(id).finally(() => {
                    this.isLoading = false;
                });
            },
            selectLanguageForUpdate(id) {
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
            this.loadLanguages();
        },
        components: {
            LanguageForm,
            LanguageItem,
            AddItemPlaceholder
        }
    }
</script>