<template>
    <div class="single-section">
        <h2>{{ $t('resume.work_experience') }}</h2>
        <ul>
            <li v-for="exp in items" :key="exp.id">
                <div class="single-list-item">
                    <p class="item-title">{{ exp.jobtitle }}</p>
                    <p class="item-subtitle">{{ exp.employer }} | {{ exp.from_converted }} - {{ exp.to_converted }}</p>
                    <ul v-if="exp.duties && exp.duties" class="duties-list">
                        <li v-for="duty in exp.duties" :key="duty">- {{ duty }}</li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    import { mapState } from 'vuex';
    export default {
        computed: {
            ...mapState('experience', ['items'])
        }
    }
</script>