<template>
    <div class="single-group">
        <h2>{{ $t("resume.skills") }}</h2>
        <ul>
            <li v-for="skill in skillList" :key="skill">- {{ skill }}</li>
        </ul>
    </div>
</template>

<script>
import { mapGetters } from "vuex";
export default {
    computed: {
        ...mapGetters("skill", ["skillList"]),
    },
};
</script>
