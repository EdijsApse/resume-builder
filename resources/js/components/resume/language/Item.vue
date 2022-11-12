<template>
    <base-resume-item @select-item="$emit('edit-language', language.id)" @delete-item="$emit('delete-language', language.id)">
        <div class="single-detail">
            <h3>{{ language.language.name }}</h3>
        </div>
        <div class="single-detail secondary-detail">
            <h3>{{ language.level.name }}</h3>
        </div>
    </base-resume-item>
</template>

<script>
    export default {
        props: ['language'],
        emits: ['edit-language', 'delete-language']
    }
</script>