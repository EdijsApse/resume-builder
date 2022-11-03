<template>
    <base-resume-item @select-item="selectItem(language.id)" @delete-item="deleteItem(language.id)">
        <div class="single-detail">
            <h3><i class="fa-solid fa-briefcase"></i>{{ getLanguageTitle }}</h3>
        </div>
        <div class="single-detail">
            <h3><i class="fa-solid fa-user-tie"></i>{{ getLevelTitle }}</h3>
        </div>
    </base-resume-item>
</template>

<script>
    import { mapActions, mapState } from 'vuex';

    export default {
        props: ['language'],
        computed: {
            ...mapState('language', ['levels', 'languages']),
            getLevelTitle() {
                const selectedLevel = this.levels.find(level => level.value === this.language.level);
                return selectedLevel ? selectedLevel.title : '';
            },
            getLanguageTitle() {
                const selectedLanguage = this.languages.find(lang => lang.value === this.language.lang);
                return selectedLanguage ? selectedLanguage.title : '';
            }
        },
        methods: {
            ...mapActions('language', ['selectItem', 'deleteItem']),
        }
    }
</script>