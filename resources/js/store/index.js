import Vue from "vue";
import Vuex from "vuex";
import certificate from "@/store/modules/certificate.js";
import education from "@/store/modules/education.js";
import experience from "@/store/modules/experience.js";
import profile from "@/store/modules/profile.js";
import language from "@/store/modules/language.js";
import skill from "@/store/modules/skill.js";
import softSkill from "@/store/modules/soft_skill.js";
import auth from "@/store/modules/auth.js";
import alert from "@/store/modules/alert.js";

import lists from "@/store/modules/lists.js";

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        alert,
        auth,
        education,
        experience,
        profile,
        certificate,
        language,
        skill,
        lists,
        softSkill,
    },
});
