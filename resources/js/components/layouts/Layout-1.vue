<template>
    <div class="container resume-layout-container">
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

<style lang="scss">
    @import '@style/_variables.scss';
    @import '@style/_mixins.scss';

    $layout-color-dark-gray: #313744;
    $layout-color-blue: #2dbabd;

    .resume-layout-container {
        padding: 50px;
        font-family: $raleway-regular;
        color: $layout-color-dark-gray;
        .resume-photo-wrapper {
            padding: 0 $space-6 $space-6 $space-6;
            border-bottom: 1px solid $layout-color-dark-gray;
        }
        .basic-details-wrapper {
            padding-top: $space-4;
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
        .single-section {
            border-bottom: 1px solid $layout-color-dark-gray;
            padding-bottom: $space-4;
            .section-title {
                margin-bottom: $space-4;
            }
        }
        .single-list-item {
            ul {
                li {
                    margin-bottom: $space-2;
                    &:last-of-type {
                        margin-bottom: 0;
                    }
                }
            }
            .item-title {
                color: $layout-color-blue;
                font-family: $raleway-semibold;
                font-size: 0.8rem;
                margin-bottom: 0;
            }
            .item-subtitle {
                font-family: $raleway-bold;
                font-size: 0.8rem;
                margin-bottom: $space-1;
                .regular {
                    font-family: $raleway-regular;
                }
            }
            .item-description {
                white-space: pre-wrap;
                font-size: 0.7rem;
                margin-bottom: 0;
            }
        }
        .grouped-section {
            display: grid;
            grid-template-columns: 50% 50%;
            .single-group {
                &:nth-child(2) {
                    padding-left: $space-6;
                    border-left: 1px solid $layout-color-dark-gray;
                }
                h2 {
                    margin-top: $space-6;
                }
                ul {
                    li {
                        font-size: 0.8rem;
                        margin-bottom: 0;
                    }
                }
            }
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
    }

</style>