<template>
    <base-container>
        <template #header>{{ $t('resume.create_resume') }}</template>
        <template #default>
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-3 mobile-fixed-sidebar" ref="sidebar" >
                        <div class="left-sidebar">
                            <div class="close-icon" @click="$refs.sidebar.classList.remove('visible')">
                                <i class="fa-solid fa-xmark"></i>
                            </div>
                            <h3>{{ $t('resume.sections') }}</h3>
                            <ul>
                                <li @click="activeComponent = 'Profile'" :class="{'selected-section': activeComponent === 'Profile', 'completed': hasProfileCreated}">
                                    <i class="fa-regular fa-square-check"></i>
                                    <span>{{ $t('forms.basic_information') }}</span>
                                </li>
                                <li @click="activeComponent = 'Experience'" :class="{'selected-section': activeComponent === 'Experience', 'completed': hasExperiences}">
                                    <i class="fa-regular fa-square-check"></i>
                                    <span>{{ $t('resume.work_experience') }}</span>
                                </li>
                                <li @click="activeComponent = 'Education'" :class="{'selected-section': activeComponent === 'Education', 'completed': hasEducations}">
                                    <i class="fa-regular fa-square-check"></i>
                                    <span>{{ $t('resume.education') }}</span>
                                </li>
                                <li @click="activeComponent = 'Certificate'" :class="{'selected-section': activeComponent === 'Certificate', 'completed': hasCertificates}">
                                    <i class="fa-regular fa-square-check"></i>
                                    <span>{{ $t('resume.certificate') }}</span>
                                </li>
                                <li @click="activeComponent = 'Language'" :class="{'selected-section': activeComponent === 'Language', 'completed': hasLanguages}">
                                    <i class="fa-regular fa-square-check"></i>
                                    <span>{{ $t('admin.languages') }}</span>
                                </li>
                                <li @click="activeComponent = 'Skill'" :class="{'selected-section': activeComponent === 'Skill', 'completed': hasSkills}">
                                    <i class="fa-regular fa-square-check"></i>
                                    <span>{{ $t('resume.skills') }}</span>
                                </li>
                            </ul>
                            <button class="btn btn-secondary mt-4 w-100" @click="$router.push({ name: 'PreviewResume' })">{{ $t('resume.preview_resume') }}</button>
                            <div v-if="hasProfileCreated" class="mt-6">
                                <a :href="`${user.resume_link}?lang=${$i18n.locale}`" target="_BLANK" class="btn btn-primary">{{ $t('resume.download_resume') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-9">
                        <component :is="activeComponent" @next-step="nextStep" />
                    </div>
                </div>
                <div class="sidebar-toggler" @click="$refs.sidebar.classList.add('visible')">
                    <i class="fa-solid fa-list"></i>
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
    import { mapGetters, mapState } from 'vuex';

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
            ...mapState('auth', ['user']),
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
        },
        watch: {
            '$route': function() {
                this.$refs.sidebar.classList.remove('visible');
            },
            'activeComponent': function() {
                this.$refs.sidebar.classList.remove('visible');
            }
        }
    }
</script>

<style scoped lang="scss">
    @import "@style/_variables.scss";
    .container {
        margin-top: 4rem;
    }
</style>