<template>
    <form @submit.prevent="save">
        <div class="resume-section-item">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Job title" v-model="jobtitle" />
            </div>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Employer" v-model="employer" />
            </div>
            <div class="form-group-row">
                <div class="form-group">
                    <date-picker
                        v-model="date_from"
                        type="month"
                        placeholder="Date from"
                        :popup-style="{ top: '100%', left: 0}"
                        :append-to-body="false"
                        format="MMMM YYYY"
                        input-class="form-control"
                    ></date-picker>
                </div>
                <div class="form-group">
                    <date-picker
                        v-model="date_to"
                        type="month"
                        placeholder="Date to"
                        :popup-style="{ top: '100%', left: 0}"
                        :append-to-body="false"
                        format="MMMM YYYY"
                        input-class="form-control"
                    ></date-picker>
                </div>
            </div>
            <div class="form-group">
                <textarea placeholder="Short list of duties" class="form-control" v-model="duties"></textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-6">Save</button>
    </form>
</template>

<script>
    import { mapActions, mapState } from 'vuex';
    export default {
        data() {
            return {
                jobtitle: '',
                employer: '',
                date_from: '',
                date_to: '',
                duties: '',
            }
        },
        computed: {
            ...mapState('experience', ['selectedItem']),
            isUpdating() {
                return this.selectedItem !== null;
            }
        },
        mounted() {
            if(this.isUpdating) {
                this.jobtitle = this.selectedItem.jobtitle;
                this.employer = this.selectedItem.employer;
                this.date_from = this.selectedItem.date_from;
                this.date_to = this.selectedItem.date_to;
                this.duties = this.selectedItem.duties;
            }
        },
        methods: {
            ...mapActions('experience', ['addItem', 'updateItem']),
            save() {
                const exp = {
                    jobtitle: this.jobtitle,
                    employer: this.employer,
                    date_from: this.date_from,
                    date_to: this.date_to,
                    duties: this.duties
                }
                if (this.isUpdating) {
                    const newExp = {...exp, id: this.selectedItem.id};
                    this.updateItem({
                        id: this.selectedItem.id,
                        newItem: newExp
                    })
                } else {
                    this.addItem({...exp, id: Date.now()})
                }
            }
        }
    }
</script>