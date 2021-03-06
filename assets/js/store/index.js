import Vue from 'vue'
import vuex from 'vuex'
import axios from 'axios'
import pagesContents, {MODULE_PAGES_CONTENTS} from "./modules/pagesContents";

Vue.use(vuex, axios)

export default new vuex.Store({
    modules: {
        pagesContents,
    },
    state: {
        allContentsCount: undefined,
        contentsLoadedCount: 0,
    },
    actions: {
        updatePageContentsActionsCount({commit}) {
            commit('SET_ALL_CONTENTS_COUNT', Object.keys(pagesContents.actions).length);
        },
        loadAllPagesContents({dispatch, commit}) {
            commit('RESET_CONTENTS_LOADED_COUNT');
            dispatch('updatePageContentsActionsCount');
            for (const action in pagesContents.actions) {
                dispatch(MODULE_PAGES_CONTENTS + '/' + action);
            }
        },
    },
    mutations: {
        SET_ALL_CONTENTS_COUNT (state, data) {
            state.allContentsCount = data;
        },
        RESET_CONTENTS_LOADED_COUNT (state) {
            state.contentsLoadedCount = 0;
        },
        INCREMENT_CONTENTS_LOADED_COUNT (state) {
            state.contentsLoadedCount++;
        }
    }
})