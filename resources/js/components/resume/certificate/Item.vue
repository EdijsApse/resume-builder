<template>
    <base-resume-item @select-item="$emit('edit-certificate', certificate.id)" @delete-item="$emit('delete-certificate', certificate.id)">
        <div class="single-detail">
            <h3>{{ certificate.name }} / {{ certificate.organization }}</h3>
        </div>
        <div class="single-detail secondary-detail">
            <h3>{{ certificate.issued_converted }}</h3>
        </div>
    </base-resume-item>
</template>

<script>
    export default {
        props: ['certificate'],
        emits: ['edit-certificate', 'delete-certificate']
    }
</script>