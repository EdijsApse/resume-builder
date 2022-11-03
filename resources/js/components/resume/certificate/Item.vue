<template>
    <base-resume-item @select-item="selectItem(certificate.id)" @delete-item="deleteItem(certificate.id)">
        <div class="single-detail">
            <h3><i class="fa-solid fa-graduation-cap"></i>{{ certificate.name }}</h3>
        </div>
        <div class="single-detail">
            <h3><i class="fa-solid fa-house"></i>{{ certificate.organization }}</h3>
        </div>
    </base-resume-item>
</template>

<script>
    import { mapActions } from 'vuex';

    export default {
        props: ['certificate'],
        methods: {
            ...mapActions('certificate', ['selectItem', 'deleteItem'])
        }
    }
</script>