<template>
    <div class="resume-section-wrapper relative">
        <transition name="fade">
            <LoadingSpinner v-if="isLoading" />
        </transition>
        <base-resume-section-header @close-form="closeForm" :isCloseButtonVisible="!isListVisible">{{ $t('resume.certificates') }}</base-resume-section-header>
        <Transition name="fade" mode="out-in">
            <div v-if="isListVisible" class="mt-8">
                <CertificateItem
                    v-for="certificate in items"
                    :key="certificate.id"
                    :certificate="certificate"
                    @edit-certificate="selectCertificateForUpdate"
                    @delete-certificate="deleteCertificate"
                />
                <AddItemPlaceholder @add-item="isListVisible = false" />
                <button class="btn btn-primary" @click="navigateToNextStep">{{ $t('resume.next') }}</button>
            </div>
            <CertificateForm v-else @show-list="isListVisible = true" />
        </Transition>
    </div>
</template>

<script>
    import CertificateForm from '@components/resume/certificate/Form.vue'
    import CertificateItem from '@components/resume/certificate/Item.vue'
    import AddItemPlaceholder from '@components/AddItemPlaceholder.vue'
    import { mapActions, mapState } from 'vuex'

    export default {
        data() {
            return {
                nextStep: 'Language',
                isLoading: false,
                isListVisible: true
            }
        },
        computed: {
            ...mapState('certificate', ['items']),
        },
        methods: {
            ...mapActions('certificate', ['loadItems', 'selectItem', 'clearSelectedItem', 'deleteItem']),
            async loadCertificates() {
                this.isLoading = true;
                await this.loadItems().finally(() => {
                    this.isLoading = false;
                })
            },
            async deleteCertificate(id) {
                this.isLoading = true;
                await this.deleteItem(id).finally(() => {
                    this.isLoading = false;
                });
            },
            selectCertificateForUpdate(id) {
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
            this.loadCertificates();
        },
        components: {
            CertificateForm,
            CertificateItem,
            AddItemPlaceholder
        }
    }
</script>