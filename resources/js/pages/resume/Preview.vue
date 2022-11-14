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
                    <div class="col-9">
                        <div class="preview-wrapper relative">
                            <div class="resume-preview">
                                <transition name="fade">
                                    <LoadingSpinner v-if="isLoading">
                                        <transition name="fade" mode="out-in">
                                            <h3 class="mt-2 loading-text" :key="loadingText">{{ loadingText }}</h3>
                                        </transition>
                                    </LoadingSpinner>
                                </transition>
                                <Layout1 v-if="hasProfileCreated && !isLoading" />
                                <div v-else-if="!hasProfileCreated && !isLoading" class="no-resume-box">
                                    <h3 class="no-resume-text">Please fill "Basic information" in Create page!</h3>
                                    <router-link :to="{ name: 'CreateResume', params: {activeComponent: 'Profile'} }" class="btn btn-primary mt-2">Add details</router-link>
                                </div>
                            </div>
                            <div v-if="hasProfileCreated && !isLoading" class="mt-6">
                                <button class="btn btn-primary" @click="download">Download resume</button>
                            </div>
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
            ...mapState('auth', ['user']),
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
            }
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
            ...mapActions('alert', ['setErrorAlert']),
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
            },
            download() {
                const hrefEl = document.createElement('a');
                hrefEl.setAttribute('href', this.user.resume_link);
                hrefEl.setAttribute('target', '_BLANK');
                hrefEl.style.display = 'none';
                document.body.appendChild(hrefEl);
                hrefEl.click();
                console.log(this.user);
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
    .preview-wrapper {
        max-width: 800px;
        margin-left: 5rem;
        .resume-preview {
            border: 1px solid #EEEEEE;
            min-height: 10rem;
            padding: $space-4;
        }
    }
    .loading-text {
        color: $bright-gray;
        font-family: $open-sans-light;
    }

    .no-resume-box {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        .no-resume-text {
            color: $dark-gray;
            margin-top: $space-4;
            font-family: $open-sans-light;
            text-align: center;
        }
    }
</style>