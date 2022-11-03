<template>
    <div class="resume-section-wrapper">
        <h2>Work experience</h2>
        <Transition name="fade" mode="out-in">
            <div v-if="isListVisible">
                <ExperienceItem v-for="experience in items" :key="experience.id" :experience="experience" />
                <AddItemPlaceholder @add-item="addListVisibilityState(false)" />
                <button class="btn btn-primary" @click="save">Next</button>
            </div>
            <ExperienceForm v-else />
        </Transition>
    </div>
</template>

<script>
    import ExperienceForm from '@components/resume/experience/Form.vue'
    import ExperienceItem from '@components/resume/experience/Item.vue'
    import AddItemPlaceholder from '@components/AddItemPlaceholder.vue'
    import { mapActions, mapState } from 'vuex'

    export default {
        data() {
            return {
                nextStep: 'Education'
            }
        },
        computed: {
            ...mapState('experience', ['items', 'isListVisible']),
            hasItemsAdded() {
                return this.items.length
            }
        },
        methods: {
            ...mapActions('experience', ['addListVisibilityState', 'clearSelectedItem']),
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
            ExperienceForm,
            ExperienceItem,
            AddItemPlaceholder
        }
    }
</script>