<template>
    <div class="resume-section-wrapper">
        <h2>Certificates</h2>
        <Transition name="fade" mode="out-in">
            <div v-if="isListVisible">
                <CertificateItem v-for="certificate in items" :key="certificate.id" :certificate="certificate" />
                <AddItemPlaceholder @add-item="addListVisibilityState(false)" />
                <button class="btn btn-primary" @click="save">Next</button>
            </div>
            <CertificateForm v-else />
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
                nextStep: 'Education'
            }
        },
        computed: {
            ...mapState('certificate', ['items', 'isListVisible']),
            hasItemsAdded() {
                return this.items.length
            }
        },
        methods: {
            ...mapActions('certificate', ['addListVisibilityState', 'clearSelectedItem']),
            save() {
                this.$emit('next-step', this.nextStep);
            }
        },
        beforeUnmount() {
            this.clearSelectedItem();
            if (!this.hasItemsAdded) {
                this.addListVisibilityState(false);
            } else {
                this.addListVisibilityState(true);
            }
        },
        components: {
            CertificateForm,
            CertificateItem,
            AddItemPlaceholder
        }
    }
</script>