<template>
    <base-resume-item @select-item="selectItem(experience.id)" @delete-item="deleteItem(experience.id)">
        <div class="single-detail">
            <h3><i class="fa-solid fa-briefcase"></i>{{ experience.jobtitle }} ({{ experience.date_from | toHumanReadable }} - {{ experience.date_to | toHumanReadable }})</h3>
        </div>
        <div class="single-detail">
            <h3><i class="fa-solid fa-user-tie"></i>{{ experience.employer }}</h3>
        </div>
    </base-resume-item>
</template>

<script>
    import { mapActions } from 'vuex';

    export default {
        props: ['experience'],
        methods: {
            ...mapActions('experience', ['selectItem', 'deleteItem'])
        }
    }
</script>