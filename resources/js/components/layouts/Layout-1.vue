<template>
    <div class="container layout-1">
        <Header v-if="hasProfileCreated" />
        <div class="row margin-top-6">
            <div class="col-4" v-if="hasProfileCreated">
                <Contacts v-if="hasProfileCreated" class="mt-6" />
                <Skill v-if="hasSkills" class="single-group" />
                <SoftSkills v-if="hasSoftSkills" class="single-group" />
                <Language v-if="hasLanguages" class="single-group" />
            </div>
            <div class="col-8">
                <Experience v-if="hasExperiences" class="mt-6" />

                <Education v-if="hasEducations" class="mt-6" />

                <Certificate v-if="hasCertificates" class="mt-6" />
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from "vuex";
import Header from "@components/preview/Header.vue";
import Contacts from "@components/preview/Contacts.vue";
import Experience from "@components/preview/Experience.vue";
import Certificate from "@components/preview/Certificate.vue";
import Education from "@components/preview/Education.vue";
import Skill from "@components/preview/Skill.vue";
import SoftSkills from "@components/preview/SoftSkills.vue";
import Language from "@components/preview/Language.vue";

export default {
    computed: {
        ...mapGetters("profile", ["hasProfileCreated"]),
        ...mapGetters("skill", ["hasSkills"]),
        ...mapGetters("softSkill", ["hasSoftSkills"]),
        ...mapGetters("certificate", ["hasCertificates"]),
        ...mapGetters("education", ["hasEducations"]),
        ...mapGetters("experience", ["hasExperiences"]),
        ...mapGetters("language", ["hasLanguages"]),
    },
    components: {
        Header,
        Contacts,
        Experience,
        Certificate,
        Skill,
        SoftSkills,
        Language,
        Education,
        SoftSkills,
    },
};
</script>
