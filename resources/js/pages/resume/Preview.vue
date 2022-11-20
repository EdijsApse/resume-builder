<template>
    <base-container>
        <template #header>Preview resume</template>
        <template #default>
            <div class="container resume-preview-container">
                <div class="row">
                    <div class="col-12 col-lg-3 mobile-fixed-sidebar" ref="sidebar">
                        <div class="left-sidebar">
                            <div class="close-icon" @click="$refs.sidebar.classList.remove('visible')">
                                <i class="fa-solid fa-xmark"></i>
                            </div>
                            <h3>{{ $t('resume.sections') }}</h3>
                            <ul>
                                <li @click="$router.push({ name: 'CreateResume', params: {activeComponent: 'Profile'} })">
                                    <i class="fa-solid" :class="{
                                        'created fa-check': hasProfileCreated,
                                        'need-to-create fa-exclamation': !hasProfileCreated
                                    }"></i>
                                    <span>{{ $t('forms.basic_information') }}</span>
                                </li>
                                <li @click="$router.push({ name: 'CreateResume', params: {activeComponent: 'Experience'} })">
                                    <i class="fa-solid" :class="{
                                        'created fa-check': hasExperiences,
                                        'need-to-create fa-exclamation': !hasExperiences
                                    }"></i>
                                    <span>{{ $t('resume.work_experience') }}</span>
                                </li>
                                <li @click="$router.push({ name: 'CreateResume', params: {activeComponent: 'Education'} })">
                                    <i class="fa-solid" :class="{
                                        'created fa-check': hasEducations,
                                        'need-to-create fa-exclamation': !hasEducations
                                    }"></i>
                                   <span>{{ $t('resume.education') }}</span>
                                </li>
                                <li @click="$router.push({ name: 'CreateResume', params: {activeComponent: 'Certificate'} })">
                                    <i class="fa-solid" :class="{
                                        'created fa-check': hasCertificates,
                                        'need-to-create fa-exclamation': !hasCertificates
                                    }"></i>
                                    <span>{{ $t('resume.certificate') }}</span>
                                </li>
                                <li @click="$router.push({ name: 'CreateResume', params: {activeComponent: 'Language'} })">
                                    <i class="fa-solid" :class="{
                                        'created fa-check': hasLanguages,
                                        'need-to-create fa-exclamation': !hasLanguages
                                    }"></i>
                                    <span>{{ $t('admin.languages') }}</span>
                                </li>
                                <li @click="$router.push({ name: 'CreateResume', params: {activeComponent: 'Skill'} })">
                                    <i class="fa-solid" :class="{
                                        'created fa-check': hasSkills,
                                        'need-to-create fa-exclamation': !hasSkills
                                    }"></i>
                                    <span>{{ $t('resume.skills') }}</span>
                                </li>
                            </ul>
                            <button class="btn btn-secondary mt-4 w-100" @click="$router.push({ name: 'CreateResume' })">{{ $t('resume.update_resume') }}</button>
                        </div>
                    </div>
                    <div class="col-12 col-lg-9">
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
                                    <h3 class="no-resume-text">{{ $t('resume.please_fill_basic_information') }}</h3>
                                    <router-link :to="{ name: 'CreateResume', params: {activeComponent: 'Profile'} }" class="btn btn-primary mt-2">{{ $t('resume.add_details') }}</router-link>
                                </div>
                            </div>
                            <div v-if="hasProfileCreated && !isLoading" class="mt-6">
                                <a :href="`${user.resume_link}?lang=${$i18n.locale}`" target="_BLANK" class="btn btn-primary d-inline">{{ $t('resume.download_resume') }}</a>
                            </div>
                        </div>
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
                this.loadingText = this.$t('resume.loading_profile');
                await this.loadUserProfile().then(() => {
                    this.loadingText = this.$t('resume.loading_educations');
                    return this.loadEducations();
                }).then(() => {
                    this.loadingText = this.$t('resume.loading_experience');
                    return this.loadExperiences();
                }).then(() => {
                    this.loadingText = this.$t('resume.loading_languages');
                    return this.loadLanguages();
                }).then(() => {
                    this.loadingText = this.$t('resume.loading_certificates');
                    return this.loadCertificates();
                }).then(() => {
                    this.loadingText = this.$t('resume.loading_skills');
                    return this.loadSkills();
                }).finally(() => {
                    this.loadingText = '';
                    this.isLoading = false;
                })
            }
        },
        components: {
            Layout1
        },
        watch: {
            '$route': function() {
                this.$refs.sidebar.classList.remove('visible');
            }
        }
    }
</script>

<style scoped lang="scss">
    @import '@style/_variables.scss';
    .resume-preview-container {
        margin-top: 4rem;
    }
    .preview-wrapper {
        max-width: 800px;
        margin-left: 5rem;
        @media (max-width: $screen-xl) {
            width: 100%;
            max-width: unset;
            margin-left: 0;
        }
        .resume-preview {
            border: 1px solid #EEEEEE;
            min-height: 10rem;
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