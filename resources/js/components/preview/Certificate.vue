<template>
    <div class="single-section">
        <h2>{{ $t('resume.additional_educations') }}</h2>
        <ul>
            <li v-for="cert in items" :key="cert.id">
                <div class="single-list-item">
                    <p class="item-title">{{ cert.organization }}</p>
                    <p class="item-subtitle">{{ $t('resume.certificate') }} | {{ cert.name }}</p>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    import { mapState } from 'vuex';
    export default {
        computed: {
            ...mapState('certificate', ['items'])
        }
    }
</script>