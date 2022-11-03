import { ADD_BASIC_INFORMATION, ADD_PROFILE_PHOTO } from '@/store/mutations.js';

export default {
    namespaced: true,
    state: {
        profile: null,
        profilePhoto: null
    },
    mutations: {
        [ADD_BASIC_INFORMATION](state, profile) {
            state.profile = profile;
        },
        [ADD_PROFILE_PHOTO](state, photo) {
            state.profilePhoto = photo;
        },
    },
    actions: {
        addBasicInformation({commit}, profile) {
            commit(ADD_BASIC_INFORMATION, profile)
        },
        clearProfilePhoto({commit}) {
            commit(ADD_PROFILE_PHOTO, null);
        },
        addProfilePhoto({commit}, photo) {
            commit(ADD_PROFILE_PHOTO, photo);
        }
    }
}