<template>
    <base-resume-item @select-item="selectItem(education.id)" @delete-item="deleteItem(education.id)">
        <div class="single-detail">
            <h3><i class="fa-solid fa-graduation-cap"></i>{{ education.degree }}</h3>
        </div>
        <div class="single-detail">
            <h3><i class="fa-solid fa-house"></i>{{ education.school }}</h3>
        </div>
    </base-resume-item>
</template>

<script>
    import { mapActions } from 'vuex';

    export default {
        props: ['education'],
        methods: {
            ...mapActions('education', ['selectItem', 'deleteItem'])
        }
    }
</script>