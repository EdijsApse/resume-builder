<template>
    <form @submit.prevent="save">
        <div class="resume-section-item">
            <div class="form-group">
                <select class="form-control" v-model="lang">
                    <option value="" selected>Language</option>
                    <option v-for="language in languages" :key="language.value" :value="language.value">{{ language.title }}</option>
                </select>
            </div>
            
            <div class="form-group">
                <select class="form-control" v-model="level">
                    <option value="" selected>Proficiency</option>
                    <option v-for="level in levels" :key="level.value" :value="level.value">{{ level.title }}</option>
                </select>
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
                lang: '',
                level: '',
            }
        },
        computed: {
            ...mapState('language', ['selectedItem', 'languages', 'levels']),
            isUpdating() {
                return this.selectedItem !== null;
            }
        },
        mounted() {
            if(this.isUpdating) {
                this.lang = this.selectedItem.lang;
                this.level = this.selectedItem.level;
            }
        },
        methods: {
            ...mapActions('language', ['addItem', 'updateItem']),
            save() {
                const language = {
                    lang: this.lang,
                    level: this.level
                }
                if (this.isUpdating) {
                    const newLanguage = {...language, id: this.selectedItem.id};
                    this.updateItem({
                        id: this.selectedItem.id,
                        newItem: newLanguage
                    })
                } else {
                    this.addItem({...language, id: Date.now()})
                }
            }
        }
    }
</script>