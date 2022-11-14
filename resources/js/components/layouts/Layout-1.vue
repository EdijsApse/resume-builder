<template>
    <div class="container layout-1">
        <Header v-if="hasProfileCreated" />
        <div class="row margin-top-6">
            <div class="col-4" v-if="hasProfileCreated">
                <Contacts v-if="hasProfileCreated" class="mt-6" />
            </div>
            <div class="col-8">
                <Experience v-if="hasExperiences" class="mt-6" />

                <Education v-if="hasEducations" class="mt-6" />
                
                <Certificate v-if="hasCertificates" class="mt-6" />

                <div class="grouped-section" v-if="hasSkills || hasLanguages">
                    <Skill v-if="hasSkills" class="single-group" />
                    <Language v-if="hasLanguages" class="single-group" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex';
    import Header from '@components/preview/Header.vue';
    import Contacts from '@components/preview/Contacts.vue';
    import Experience from '@components/preview/Experience.vue';
    import Certificate from '@components/preview/Certificate.vue';
    import Education from '@components/preview/Education.vue';
    import Skill from '@components/preview/Skill.vue';
    import Language from '@components/preview/Language.vue';

    export default {
        computed: {
            ...mapGetters('profile', ['hasProfileCreated']),
            ...mapGetters('skill', ['hasSkills']),
            ...mapGetters('certificate', ['hasCertificates']),
            ...mapGetters('education', ['hasEducations']),
            ...mapGetters('experience', ['hasExperiences']),
            ...mapGetters('language', ['hasLanguages'])
        },
        components: {
            Header,
            Contacts,
            Experience,
            Certificate,
            Skill,
            Language,
            Education
        }
    }
</script>