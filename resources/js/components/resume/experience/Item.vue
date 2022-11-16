<template>
    <base-resume-item @select-item="$emit('edit-experience', experience.id)" @delete-item="$emit('delete-experience', experience.id)">
        <div class="single-detail">
            <h3>{{ experience.jobtitle }} at {{ experience.employer }}</h3>
        </div>
        <div class="single-detail secondary-detail">
            <h3>{{ experience.from_converted }} - {{ !experience.is_current ? experience.to_converted : 'Present' }}</h3>
        </div>
        <div class="description-details" v-if="experience.duties">
            <p class="mb-0">{{ experience.duties }}</p>
        </div>
    </base-resume-item>
</template>

<script>
    export default {
        props: ['experience'],
        emits: ['edit-experience', 'delete-experience'],
    }
</script>