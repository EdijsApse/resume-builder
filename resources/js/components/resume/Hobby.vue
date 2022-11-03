<template>
    <div class="resume-section-wrapper">
        <h2>Hobbies</h2>
        <form @submit.prevent="addHobby" class="single-items-form">
            <div class="form-group">
                <input type="text" placeholder="Enter hobby" class="form-control" v-model.trim="item" />
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-circle-plus"></i>Add</button>
            </div>
        </form>
        <div class="single-items-list" v-if="hasHobbies">
            <base-list-item v-for="hobby in items" :key="hobby.id" @remove-item="removeItem(hobby.id)">
                {{ hobby.value }}
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
            }
        },
        computed: {
            ...mapState('hobby', ['items']),
            hasHobbies() {
                return !!this.items.length;
            }
        },
        methods: {
            ...mapActions('hobby', ['addItem', 'removeItem']),
            addHobby() {
                const hobby = {
                    id: Date.now(),
                    value: this.item
                };
                this.addItem(hobby)
                this.item = '';
            }
        }
    }
</script>