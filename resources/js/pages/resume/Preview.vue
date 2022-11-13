<template>
    <base-container>
        <template #header>Preview resume</template>
        <template #default>
            <div class="container resume-preview-container">
                <div class="row">
                    <div class="col-3">
                        <div class="left-sidebar">
                            <h3>Sections</h3>
                            <ul>
                                <li @click="$router.push({ name: 'CreateResume', params: {activeComponent: 'Profile'} })">
                                    <i class="fa-solid" :class="{
                                        'created fa-check': hasProfileCreated,
                                        'need-to-create fa-exclamation': !hasProfileCreated
                                    }"></i>
                                    <span>Basic information</span>
                                </li>
                                <li @click="$router.push({ name: 'CreateResume', params: {activeComponent: 'Experience'} })">
                                    <i class="fa-solid" :class="{
                                        'created fa-check': hasExperiences,
                                        'need-to-create fa-exclamation': !hasExperiences
                                    }"></i>
                                    <span>Work experience</span>
                                </li>
                                <li @click="$router.push({ name: 'CreateResume', params: {activeComponent: 'Education'} })">
                                    <i class="fa-solid" :class="{
                                        'created fa-check': hasEducations,
                                        'need-to-create fa-exclamation': !hasEducations
                                    }"></i>
                                    <span>Education</span>
                                </li>
                                <li @click="$router.push({ name: 'CreateResume', params: {activeComponent: 'Certificate'} })">
                                    <i class="fa-solid" :class="{
                                        'created fa-check': hasCertificates,
                                        'need-to-create fa-exclamation': !hasCertificates
                                    }"></i>
                                    <span>Certificate</span>
                                </li>
                                <li @click="$router.push({ name: 'CreateResume', params: {activeComponent: 'Language'} })">
                                    <i class="fa-solid" :class="{
                                        'created fa-check': hasLanguages,
                                        'need-to-create fa-exclamation': !hasLanguages
                                    }"></i>
                                    <span>Languages</span>
                                </li>
                                <li @click="$router.push({ name: 'CreateResume', params: {activeComponent: 'Skill'} })">
                                    <i class="fa-solid" :class="{
                                        'created fa-check': hasSkills,
                                        'need-to-create fa-exclamation': !hasSkills
                                    }"></i>
                                    <span>Skills</span>
                                </li>
                            </ul>
                            <button class="btn btn-secondary mt-4 w-100" @click="$router.push({ name: 'CreateResume' })">Update Resume</button>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </base-container>
</template>

<script>
    import Layout1 from '@components/layouts/Layout-1.vue';
    import { mapActions, mapState, mapGetters } from 'vuex';

    export default {
        data() {
            return {
                loadingText: '',
                isLoading: false
            }
        },
        computed: {
            ...mapState('profile', ['profile']),
            ...mapState('education', { educations: 'items' }),
            ...mapState('experience', { experiences: 'items' }),
            ...mapState('language', { languages: 'items' }),
            ...mapState('skill', { skills: 'items' }),
            ...mapState('certificate', { certificates: 'items' }),
            ...mapGetters('profile', ['hasProfileCreated']),
            ...mapGetters('skill', ['hasSkills']),
            hasEducations() {
                return !!this.educations.length;
            },
            hasExperiences() {
                return !!this.experiences.length;
            },
            hasLanguages() {
                return !!this.languages.length;
            },
            hasCertificates() {
                return !!this.certificates.length;
            },
        },
        mounted() {
            this.loadResume();
        },
        methods: {
            ...mapActions('profile', ['loadUserProfile']),
            ...mapActions('education', { loadEducations: 'loadItems'}),
            ...mapActions('experience', { loadExperiences: 'loadItems'}),
            ...mapActions('language', { loadLanguages: 'loadItems'}),
            ...mapActions('certificate', { loadCertificates: 'loadItems'}),
            ...mapActions('skill', { loadSkills: 'loadItems'}),
            async loadResume() {
                this.isLoading = true;
                this.loadingText = 'Loading profile!';
                await this.loadUserProfile().then(() => {
                    this.loadingText = 'Loading educations!';
                    return this.loadEducations();
                }).then(() => {
                    this.loadingText = 'Loading working experiences!';
                    return this.loadExperiences();
                }).then(() => {
                    this.loadingText = 'Loading languages!';
                    return this.loadLanguages();
                }).then(() => {
                    this.loadingText = 'Loading certificates!';
                    return this.loadCertificates();
                }).then(() => {
                    this.loadingText = 'Loading skills!';
                    return this.loadSkills();
                }).finally(() => {
                    this.loadingText = '';
                    this.isLoading = false;
                })
            }
        },
        components: {
            Layout1
        }
    }
</script>

<style scoped lang="scss">
    @import '@style/_variables.scss';
    .resume-preview-container {
        margin-top: 4rem;
        margin-bottom: 4rem;
    }
    .single-section-icon {
        color: $danger;
        &.has-filled {
            color: $success;
        }
    }
</style>