<template>
    <div class="container resume-layout-container">
        <div class="row" v-if="hasProfileInfo && profilePhoto">
            <div class="col-4">
                <div class="resume-photo-wrapper h-100">
                    <div class="resume-photo">
                        <img :src="profilePhoto" />
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="profile-section h-100">
                    <h1>{{ fullName }}</h1>
                    <h2>{{ profile.occupation }}</h2>
                    <p>{{ profile.about }}</p>
                </div>
            </div>
        </div>
        <div class="row margin-top-6">
            <div class="col-4" v-if="hasProfileInfo">
                <div class="contact-section">
                    <h2>Contact</h2>
                    <ul>
                        <li>
                            <div class="single-contact">
                                <p class="contact-type">Mobile</p>
                                <p class="contact-value">{{ profile.phone }}</p>
                            </div>
                        </li>
                        <li>
                            <div class="single-contact">
                                <p class="contact-type">Email</p>
                                <p class="contact-value">{{ profile.email }}</p>
                            </div>
                        </li>
                        <li>
                            <div class="single-contact">
                                <p class="contact-type">Website</p>
                                <p class="contact-value">Portfolio can be viewed <a :href="profile.link">here</a></p>
                            </div>
                        </li>
                        <li>
                            <div class="single-contact">
                                <p class="contact-type">Address</p>
                                <p class="contact-value">{{ profile.address }}</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-8">
                <div class="experience-section" v-if="hasExperiences">
                    <h2>Work experience</h2>
                    <ul>
                        <li v-for="exp in experiences" :key="exp.id">
                            <div class="single-experience">
                                <p class="jobtitle">{{ exp.jobtitle }}</p>
                                <p class="employer">{{ exp.employer }} | {{ exp.date_from | toHumanReadable }} - {{ exp.date_to | toHumanReadable }}</p>
                                <p class="duties">{{ exp.duties }}</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="experience-section margin-top-6" v-if="hasEducation">
                    <h2>Education</h2>
                    <ul>
                        <li v-for="edu in educations" :key="edu.id">
                            <div class="single-experience">
                                <p class="jobtitle">{{ edu.school }}</p>
                                <p class="employer mb-0">{{ edu.degree }} | {{ edu.field }}</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="experience-section margin-top-6" v-if="hasCertificates">
                    <h2>Additional educations</h2>
                    <ul>
                        <li v-for="cert in certificates" :key="cert.id">
                            <div class="single-experience">
                                <p class="jobtitle">{{ cert.organization }}</p>
                                <p class="employer mb-0">Certificate | {{ cert.name }}</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="experience-section border-bottom-none" v-if="hasSkills && hasLanguages">
                    <div class="grouped-section">
                        <div class="skills">
                            <h2>Skills</h2>
                            <ul>
                                <li v-for="skill in skills" :key="skill.id">- {{ skill.value }}</li>
                            </ul>
                        </div>
                        <div class="languages">
                            <h2>Languages</h2>
                            <ul>
                                <li v-for="language in resumeLangauges" :key="language.id">
                                    <div class="single-experience">
                                        <p class="jobtitle">{{ getLanguageTitle(language.lang) }}:</p>
                                        <p class="employer mb-0">Proficiency: <span class="regular">{{ getLevelTitle(language.level) }}</span></p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapState } from 'vuex';

    export default {
        computed: {
            ...mapState('profile', ['profile', 'profilePhoto']),
            ...mapState('certificate', {certificates: 'items'}),
            ...mapState('education', {educations: 'items'}),
            ...mapState('experience', {experiences: 'items'}),
            ...mapState('hobby', {hobbies: 'items'}),
            ...mapState('language', {resumeLangauges: 'items', levels: 'levels', languages: 'languages'}),
            ...mapState('skill', {skills: 'items'}),
            fullName() {
                return `${this.profile.firstName} ${this.profile.lastName}` 
            },
            hasProfileInfo() {
                return this.profile !== null;
            },
            hasExperiences() {
                return this.experiences.length;
            },
            hasEducation() {
                return this.educations.length;
            },
            hasCertificates() {
                return this.certificates.length;
            },
            hasSkills() {
                return this.skills.length;
            },
            hasLanguages() {
                return this.languages.length;
            }
        },
        methods: {
            getLevelTitle(levelId) {
                const selectedLevel = this.levels.find(level => level.value === levelId);
                return selectedLevel ? selectedLevel.title : '';
            },
            getLanguageTitle(langId) {
                const selectedLanguage = this.languages.find(lang => lang.value === langId);
                return selectedLanguage ? selectedLanguage.title : '';
            }
        }
    }
</script>

<style scoped lang="scss">
    @import '@style/_variables.scss';
    @import '@style/_mixins.scss';

    $layout-color-blue: #2dbabd;
    $layout-color-dark-gray: #313744;

    .resume-layout-container {
        padding: 50px;
        font-family: $raleway-regular;
        color: $layout-color-dark-gray;
        .resume-photo-wrapper {
            padding: 0 $space-6 $space-6 $space-6;
            border-bottom: 1px solid $layout-color-dark-gray;
        }
        .resume-photo {
            @include fixed-rounded-container(170px);
            img {
                border-radius: 170px;
                width: 100%;
                height: 100%;
                object-fit: cover;
            }
        }
        .profile-section {
            padding-top: $space-4;
            border-bottom: 1px solid $layout-color-dark-gray;
        }
        h1 {
            color: $layout-color-blue;
            font-size: 1.4rem;
            margin-bottom: $space-4;
        }
        h2 {
            font-size: 1.3rem;
            margin-bottom: $space-2;
        }
        p {
            font-size: 0.8rem;
        }
        .margin-top-6 {
            margin-top: $space-6;
        }
        ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .contact-section {
            h2 {
                margin-bottom: $space-4;
            }
            ul {
                li {
                    margin-bottom: $space-2;
                    .single-contact {
                        .contact-type {
                            color: $layout-color-blue;
                            font-family: $raleway-semibold;
                            margin-bottom: 0px;
                        }
                        .contact-value {
                            margin-bottom: 0px;
                            font-size: 0.8rem;
                            a {
                                color: $layout-color-blue;
                            }
                        }
                    }
                }
            }
        }
        .experience-section {
            border-bottom: 1px solid $layout-color-dark-gray;
            padding-bottom: $space-4;
            &.border-bottom-none {
                border-bottom: none;
            }
            h2 {
                margin-bottom: $space-4;
            }
            ul {
                li {
                    margin-bottom: $space-2;
                    &:last-of-type {
                        margin-bottom: 0;
                    }
                }
            }
            .jobtitle {
                color: $layout-color-blue;
                font-family: $raleway-semibold;
                font-size: 0.8rem;
                margin-bottom: 0;
            }
            .employer {
                font-family: $raleway-bold;
                font-size: 0.8rem;
                margin-bottom: $space-1;
                .regular {
                    font-family: $raleway-regular;
                }
            }
            .duties {
                white-space: pre-wrap;
                font-size: 0.7rem;
                margin-bottom: 0;
            }
            .grouped-section {
                display: grid;
                grid-template-columns: 50% 50%;
                .skills {
                    border-right: 1px solid $layout-color-dark-gray;
                    ul {
                        li {
                            font-size: 0.8rem;
                            margin-bottom: 0;
                        }
                    }
                }
                h2 {
                    margin-top: $space-6;
                }
                .languages {
                    padding-left: $space-6;
                }
            }
        }
        
    }

</style>