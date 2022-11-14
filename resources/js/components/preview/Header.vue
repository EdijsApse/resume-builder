<template>
    <div class="row">
        <div class="col-4">
            <div class="resume-photo-wrapper h-100">
                <div class="resume-photo">
                    <img :src="profile.photo" />
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="basic-details-wrapper h-100">
                <h1>{{ `${profile.name} ${profile.surname}` }}</h1>
                <h2>{{ profile.occupation }}</h2>
                <p>{{ profile.professional_summary }}</p>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapState } from 'vuex';

    export default {
        computed: {
            ...mapState('profile', ['profile'])
        }
    }
</script>