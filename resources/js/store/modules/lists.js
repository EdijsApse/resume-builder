import { ADD_LANGUAGE_LEVELS_LIST, ADD_LANGUAGES_LIST } from '@/store/mutations.js';
import axios from '@/axios.js';

/**
 * Returns array of objects which is valid list for v-select components options prop
 * 
 * @param {*} list 
 * @returns array
 */
const vueSelectOptionList = (list) => {
    return list.map((item) => {
        return {
            value: item.id,
            label: item.name,
            code: item.code
        };
    })
};

export default {
    namespaced: true,
    state: {
        languages: [],
        language_levels: []
    },
    mutations: {
        [ADD_LANGUAGE_LEVELS_LIST](state, levels) {
            state.language_levels = levels;
        },
        [ADD_LANGUAGES_LIST](state, languages) {
            state.languages = languages;
        },
    },
    actions: {
        async loadLanguagesWithLevels({ commit }) {
            await axios.get('select-lists').then(response => {
                const { languages, language_levels } = response.data;
                if (languages) {
                    const languageList = vueSelectOptionList(languages);
                    commit(ADD_LANGUAGES_LIST, languageList);
                }

                if (language_levels) {
                    const levelList = vueSelectOptionList(language_levels);
                    commit(ADD_LANGUAGE_LEVELS_LIST, levelList);
                }
            });
        },
    }
}