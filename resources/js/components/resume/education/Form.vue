<template>
    <form @submit.prevent="save">
        <div class="resume-section-item">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Degree" v-model="degree" />
            </div>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Name of school" v-model="school" />
            </div>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Field of study" v-model="field" />
            </div>
            <!-- <div class="form-group">
                <input type="text" class="form-control" placeholder="Location" v-model="location" />
            </div>
            <div class="form-group-row">
                <div class="form-group">
                    <input type="date" class="form-control" placeholder="Start date" v-model="date_from" />
                </div>
                <div class="form-group">
                    <input type="date" class="form-control" placeholder="Graduation year" v-model="date_to" />
                </div>
            </div>
            <div class="form-group">
                <textarea placeholder="Short description" class="form-control" v-model="description"></textarea>
            </div> -->
        </div>
        <button type="submit" class="btn btn-primary mt-6">Save</button>
    </form>
</template>

<script>
    import { mapActions, mapState } from 'vuex';
    export default {
        data() {
            return {
                degree: '',
                school: '',
                field: '',
                location: '',
                date_from: '',
                date_to: '',
                description: ''
            }
        },
        computed: {
            ...mapState('education', ['selectedItem']),
            isUpdating() {
                return this.selectedItem !== null;
            }
        },
        mounted() {
            if(this.isUpdating) {
                this.degree = this.selectedItem.degree;
                this.school = this.selectedItem.school;
                this.field = this.selectedItem.field;
                this.location = this.selectedItem.location;
                this.date_from = this.selectedItem.date_from;
                this.date_to = this.selectedItem.date_to;
                this.description = this.selectedItem.description;
            }
        },
        methods: {
            ...mapActions('education', ['addItem', 'updateItem']),
            save() {
                const edu = {
                    degree: this.degree,
                    school: this.school,
                    field: this.field,
                    location: this.location,
                    date_from: this.date_from,
                    date_to: this.date_to,
                    description: this.description
                }
                if (this.isUpdating) {
                    const newEducation = {...edu, id: this.selectedItem.id};
                    this.updateItem({
                        id: this.selectedItem.id,
                        newItem: newEducation
                    })
                } else {
                    this.addItem({...edu, id: Date.now()})
                }
            }
        }
    }
</script>