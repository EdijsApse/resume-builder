<template>
    <base-resume-item @select-item="$emit('edit-education', education.id)" @delete-item="$emit('delete-education', education.id)">
        <div class="single-detail">
            <h3>{{ education.degree }} / {{ education.school }}{{ education.field ? ` / ${education.field}` : '' }}</h3>
        </div>
        <div class="single-detail secondary-detail">
            <h3>{{ education.from_converted }} - {{ !education.is_current ? education.to_converted : 'Present' }}</h3>
        </div>
        <div class="description-details" v-if="education.summary">
            <p class="mb-0">{{ education.summary }}</p>
        </div>
    </base-resume-item>
</template>

<script>
    export default {
        props: ['education'],
        emits: ['edit-education', 'delete-education']
    }
</script>