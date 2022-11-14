<template>
    <base-container>
        <template #header>Create resume</template>
        <template #default>
            <div class="container">
                <div class="row">
                    <div class="col-3">
                        <div class="left-sidebar">
                            <h3>Sections</h3>
                            <ul>
                                <li @click="activeComponent = 'Profile'" :class="{'selected-section': activeComponent === 'Profile', 'completed': hasProfileCreated}">
                                    <i class="fa-regular fa-square-check"></i>
                                    <span>Basic information</span>
                                </li>
                                <li @click="activeComponent = 'Experience'" :class="{'selected-section': activeComponent === 'Experience', 'completed': hasExperiences}">
                                    <i class="fa-regular fa-square-check"></i>
                                    <span>Work experience</span>
                                </li>
                                <li @click="activeComponent = 'Education'" :class="{'selected-section': activeComponent === 'Education', 'completed': hasEducations}">
                                    <i class="fa-regular fa-square-check"></i>
                                    <span>Education</span>
                                </li>
                                <li @click="activeComponent = 'Certificate'" :class="{'selected-section': activeComponent === 'Certificate', 'completed': hasCertificates}">
                                    <i class="fa-regular fa-square-check"></i>
                                    <span>Certificate</span>
                                </li>
                                <li @click="activeComponent = 'Language'" :class="{'selected-section': activeComponent === 'Language', 'completed': hasLanguages}">
                                    <i class="fa-regular fa-square-check"></i>
                                    <span>Languages</span>
                                </li>
                                <li @click="activeComponent = 'Skill'" :class="{'selected-section': activeComponent === 'Skill', 'completed': hasSkills}">
                                    <i class="fa-regular fa-square-check"></i>
                                    <span>Skills</span>
                                </li>
                            </ul>
                            <button class="btn btn-secondary mt-4 w-100" @click="$router.push({ name: 'PreviewResume' })">Preview Resume</button>
                        </div>
                    </div>
                    <div class="col-9">
                        <component :is="activeComponent" @next-step="nextStep" />
                    </div>
                </div>
            </div>
        </template>
    </base-container>
</template>

<script>
    import Profile from '@components/resume/Profile.vue';
    import Experience from '@components/resume/Experience.vue';
    import Education from '@components/resume/Education.vue';
    import Certificate from '@components/resume/Certificate.vue';
    import Language from '@components/resume/Language.vue';
    import Skill from '@components/resume/Skill.vue';
    import { mapGetters } from 'vuex';

    export default {
        data() {
            return {
                activeComponent: 'Profile'
            }
        },
        created() {
            const activeComponent = this.$route.params.activeComponent;
            if (activeComponent) {
                this.activeComponent = activeComponent;
            }
        },
        computed: {
            ...mapGetters('education', ['hasEducations']),
            ...mapGetters('experience', ['hasExperiences']),
            ...mapGetters('language', ['hasLanguages']),
            ...mapGetters('certificate', ['hasCertificates']),
            ...mapGetters('profile', ['hasProfileCreated']),
            ...mapGetters('skill', ['hasSkills'])
        },
        methods: {
            nextStep(nextComponent) {
                this.activeComponent = nextComponent;
            }
        },
        components: {
            Profile,
            Experience,
            Education,
            Certificate,
            Language,
            Skill
        }
    }
</script>

<style scoped lang="scss">
    @import "@style/_variables.scss";
    .container {
        margin-top: 4rem;
        margin-bottom: 4rem;
    }
</style>