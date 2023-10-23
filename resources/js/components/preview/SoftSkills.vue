<template>
    <div class="single-group">
        <h2>{{ $t("resume.soft_skills") }}</h2>
        <ul>
            <li v-for="skill in softSkillList" :key="skill">- {{ skill }}</li>
        </ul>
    </div>
</template>

<script>
import { mapGetters } from "vuex";
export default {
    computed: {
        ...mapGetters("softSkill", ["softSkillList"]),
    },
};
</script>
