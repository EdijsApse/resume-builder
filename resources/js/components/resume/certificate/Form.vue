<template>
    <form @submit.prevent="save">
        <div class="resume-section-item">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Name of certificate" v-model="name" />
            </div>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Issuing organization" v-model="organization" />
            </div>
            <!-- <div class="form-group-row">
                <div class="form-group">
                    <input type="date" class="form-control" placeholder="Issue date" v-model="date_from" />
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
                name: '',
                organization: '',
                date_from: '',
                description: ''
            }
        },
        computed: {
            ...mapState('certificate', ['selectedItem']),
            isUpdating() {
                return this.selectedItem !== null;
            }
        },
        mounted() {
            if(this.isUpdating) {
                this.name = this.selectedItem.name;
                this.organization = this.selectedItem.organization;
                this.date_from = this.selectedItem.date_from;
                this.description = this.selectedItem.description;                
            }
        },
        methods: {
            ...mapActions('certificate', ['addItem', 'updateItem']),
            save() {
                const cert = {
                    name: this.name,
                    organization: this.organization,
                    date_from: this.date_from,
                    description: this.description
                }
                if (this.isUpdating) {
                    const newCertificate = {...cert, id: this.selectedItem.id};
                    this.updateItem({
                        id: this.selectedItem.id,
                        newItem: newCertificate
                    })
                } else {
                    this.addItem({...cert, id: Date.now()})
                }
            }
        }
    }
</script>