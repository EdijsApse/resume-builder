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
                                <li @click="activeComponent = 'Profile'" :class="{'selected-section': activeComponent === 'Profile'}">
                                    <i class="fa-regular fa-square-check"></i>
                                    <span>Basic information</span>
                                </li>
                                <li @click="activeComponent = 'Experience'" :class="{'selected-section': activeComponent === 'Experience'}">
                                    <i class="fa-regular fa-square-check"></i>
                                    <span>Work experience</span>
                                </li>
                                <li @click="activeComponent = 'Education'" :class="{'selected-section': activeComponent === 'Education'}">
                                    <i class="fa-regular fa-square-check"></i>
                                    <span>Education</span>
                                </li>
                                <li @click="activeComponent = 'Certificate'" :class="{'selected-section': activeComponent === 'Certificate'}">
                                    <i class="fa-regular fa-square-check"></i>
                                    <span>Certificate</span>
                                </li>
                                <li @click="activeComponent = 'Language'" :class="{'selected-section': activeComponent === 'Language'}">
                                    <i class="fa-regular fa-square-check"></i>
                                    <span>Languages</span>
                                </li>
                                <li @click="activeComponent = 'Skill'" :class="{'selected-section': activeComponent === 'Skill'}">
                                    <i class="fa-regular fa-square-check"></i>
                                    <span>Skills</span>
                                </li>
                                <!-- <li @click="activeComponent = 'Hobby'" :class="{'selected-section': activeComponent === 'Hobby'}">
                                    <i class="fa-regular fa-square-check"></i>
                                    <span>Hobbies</span>
                                </li> -->
                            </ul>
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

    export default {
        data() {
            return {
                activeComponent: 'Skill'//'Profile'
            }
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
    .left-sidebar {
        padding-top: $space-4;
        padding-right: $space-4;
        h3 {
            font-size: 0.9rem;
            color: $dark-gray;
            margin-bottom: $space-6;
            &::after {
                display: block;
                width: 40px;
                margin-top: $space-1;
                background-color: $dark-gray;
                content: "";
                height: 2px;
            }
        }
        ul {
            list-style: none;
            margin: 0;
            padding: 0;
            li {
                display: flex;
                align-items: center;
                margin: 0;
                padding: 0;
                padding-bottom: $space-2;
                margin-bottom: $space-2;
                font-size: 0.8rem;
                color: $dark-gray;
                border-bottom: 1px dashed $bright-gray;
                cursor: pointer;
                i {
                    font-size: 1.1rem;
                    margin-right: $space-4;
                    color: $dark-gray;
                }
                &.selected-section {
                    color: $pink;
                }
            }
        }
    }
</style>