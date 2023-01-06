<template>
    <base-resume-item @select-item="$emit('edit-experience', experience.id)" @delete-item="$emit('delete-experience', experience.id)">
        <div class="single-detail">
            <h3>{{ experience.jobtitle }} at {{ experience.employer }}</h3>
        </div>
        <div class="single-detail secondary-detail">
            <h3>{{ experience.from_converted }} - {{ !experience.is_current ? experience.to_converted : this.$t('forms.present') }}</h3>
        </div>
        <div class="description-details" v-if="experience.duties && experience.duties.length">
            <p class="mb-0">{{ $t('forms.count_duties_added', { count: experience.duties.length }) }}</p>
        </div>
    </base-resume-item>
</template>

<script>
    export default {
        props: ['experience'],
        emits: ['edit-experience', 'delete-experience'],
    }
</script>