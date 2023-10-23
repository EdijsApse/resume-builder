import { SET_RESUME_SOFT_SKILLS } from "@/store/mutations.js";
import axios from "@/axios.js";
import i18n from "@/i18n/index.js";

export default {
    namespaced: true,
    state: {
        softSkill: null,
    },
    mutations: {
        [SET_RESUME_SOFT_SKILLS](state, soft_skills) {
            state.softSkill = soft_skills;
        },
    },
    actions: {
        async loadItems({ commit, getters }) {
            if (getters.hasSoftSkills) {
                return Promise.resolve();
            }
            await axios.get("/soft-skills").then((response) => {
                const { soft_skills } = response.data;
                if (soft_skills) {
                    commit(SET_RESUME_SOFT_SKILLS, soft_skills);
                }
            });
        },
        async saveItems({ commit, dispatch }, items) {
            await axios
                .post("/soft-skills", { list: items })
                .then((response) => {
                    const { success, soft_skills } = response.data;
                    if (success) {
                        commit(SET_RESUME_SOFT_SKILLS, soft_skills);
                        dispatch(
                            "alert/setSuccessAlert",
                            i18n.t("alert.soft_skill_list_saved"),
                            { root: true }
                        );
                    }
                })
                .catch((err) => {
                    dispatch(
                        "alert/setSuccessAlert",
                        i18n.t("alert.server_error"),
                        { root: true }
                    );
                });
        },
    },
    getters: {
        hasSoftSkills(state) {
            return state.softSkill !== null;
        },
        softSkillList(state) {
            return state.softSkill.list ?? [];
        },
    },
};
