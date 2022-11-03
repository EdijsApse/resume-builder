<template>
    <div class="resume-section-wrapper">
        <h2>Education</h2>
        <Transition name="fade" mode="out-in">
            <div v-if="isListVisible">
                <EducationItem v-for="education in items" :key="education.id" :education="education" />
                <AddItemPlaceholder @add-item="addListVisibilityState(false)" />
                <button class="btn btn-primary" @click="save">Next</button>
            </div>
            <EducationForm v-else />
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
                nextStep: 'Certificate'
            }
        },
        computed: {
            ...mapState('education', ['items', 'isListVisible'])
        },
        methods: {
            ...mapActions('education', ['addListVisibilityState', 'clearSelectedItem']),
            save() {
                this.$emit('next-step', this.nextStep);
            }
        },
        beforeUnmount() {
            this.clearSelectedItem();
        },
        components: {
            EducationForm,
            EducationItem,
            AddItemPlaceholder
        }
    }
</script>