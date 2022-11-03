<template>
    <div class="resume-section-wrapper">
        <h2>Languages</h2>
        <Transition name="fade" mode="out-in">
            <div v-if="isListVisible">
                <LanguageItem v-for="language in items" :key="language.id" :language="language" />
                <AddItemPlaceholder @add-item="addListVisibilityState(false)" />
                <button class="btn btn-primary" @click="save">Next</button>
            </div>
            <LanguageForm v-else />
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
                nextStep: 'Skill'
            }
        },
        computed: {
            ...mapState('language', ['items', 'isListVisible']),
            hasItemsAdded() {
                return this.items.length
            }
        },
        methods: {
            ...mapActions('language', ['addListVisibilityState', 'clearSelectedItem']),
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
            LanguageForm,
            LanguageItem,
            AddItemPlaceholder
        }
    }
</script>