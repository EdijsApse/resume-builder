<template>
    <div>
        <h2>{{ $t('admin.languages') }}</h2>
        <ul>
            <li v-for="language in items" :key="language.id">
                <div class="single-list-item">
                    <p class="item-title">{{ language.language.name }}:</p>
                    <p class="item-subtitle">{{ $t('resume.proficiency') }}: <span class="regular">{{ language.level.name }}</span></p>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    import { mapState } from 'vuex';
    export default {
        computed: {
            ...mapState('language', ['items'])
        }
    }
</script>