<template>
    <div class="resume-section-wrapper">
        <h2>Skills</h2>
        <form @submit.prevent="addSkill" class="single-items-form">
            <div class="form-group">
                <input type="text" placeholder="Enter skill" class="form-control" v-model.trim="item" />
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-circle-plus"></i>Add</button>
            </div>
        </form>
        <div class="single-items-list" v-if="hasSkills">
            <base-list-item v-for="skill in items" :key="skill.id" @remove-item="removeItem(skill.id)">
                {{ skill.value }}
            </base-list-item>
        </div>
        <button type="button" class="btn btn-primary" @click="$router.push({name: 'PreviewResume'})">Save</button>
    </div>
</template>

<script>
    import { mapState, mapActions } from 'vuex';
    export default {
        data() {
            return {
                item: '',
                nextStep: 'Hobby'
            }
        },
        computed: {
            ...mapState('skill', ['items']),
            hasSkills() {
                return !!this.items.length;
            }
        },
        methods: {
            ...mapActions('skill', ['addItem', 'removeItem']),
            save() {
                this.$emit('next-step', this.nextStep);
            },
            addSkill() {
                const skill = {
                    id: Date.now(),
                    value: this.item
                };
                this.addItem(skill)
                this.item = '';
            }
        }
    }
</script>