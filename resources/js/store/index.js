import Vue from 'vue'
import Vuex from 'vuex'
import certificate from "@/store/modules/certificate.js";
import education from "@/store/modules/education.js";
import experience from "@/store/modules/experience.js";
import profile from "@/store/modules/profile.js";
import language from "@/store/modules/language.js";
import skill from "@/store/modules/skill.js";
import hobby from "@/store/modules/hobby.js";

Vue.use(Vuex);

export default new Vuex.Store(
    {
        modules: {
            education,
            experience,
            profile,
            certificate,
            language,
            skill,
            hobby
        }
    }
)