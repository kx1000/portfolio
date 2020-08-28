import Vue from 'vue'
import vuex from 'vuex'
import axios from 'axios'
import {contentNames, ApiService} from './Service/ApiService'

Vue.use(vuex, axios)

export const actions = {
    loadHeader({commit}) {
        ApiService
            .fetchContent(contentNames.HEADER)
            .then(data => {
                commit('SET_HEADER', data)
                commit('INCREMENT_CONTENTS_LOADED_COUNT')
            })
    },
    loadFooter({commit}) {
        ApiService
            .fetchContent(contentNames.FOOTER)
            .then(data => {
                commit('SET_FOOTER', data)
                commit('INCREMENT_CONTENTS_LOADED_COUNT')
            })
    },
    loadAbout({commit}) {
        ApiService
            .fetchContent(contentNames.ABOUT)
            .then(data => {
                commit('SET_ABOUT', data)
                commit('INCREMENT_CONTENTS_LOADED_COUNT')
            })
    },
    loadProjectsList({commit}) {
        ApiService
            .fetchContent(contentNames.PROJECTS)
            .then(data => {
                commit('SET_PROJECTS_LIST', data)
                commit('INCREMENT_CONTENTS_LOADED_COUNT')
            })
    },
    loadContact({commit}) {
        ApiService
            .fetchContent(contentNames.CONTACT)
            .then(data => {
                commit('SET_CONTACT', data)
                commit('INCREMENT_CONTENTS_LOADED_COUNT')
            })
    },
    loadSentConfirmation({commit}) {
        ApiService
            .fetchContent(contentNames.SENT)
            .then(data => {
                commit('SET_SENT_CONFIRMATION', data)
                commit('INCREMENT_CONTENTS_LOADED_COUNT')
            })
    },
    loadProjects({commit}) {
        ApiService
            .fetchProjects()
            .then(data => {
                commit('SET_PROJECTS', data)
                commit('INCREMENT_CONTENTS_LOADED_COUNT')
            })
    }
};

export default new vuex.Store({
    state: {
        contentsLoadedCount: 0,
        header: '',
        footer: '',
        about: '',
        projectsList: '',
        contact: '',
        sentConfirmation: '',
        projects: [],
    },
    actions: actions,
    mutations: {
        SET_HEADER (state, data) {
            state.header = data
        },
        SET_FOOTER (state, data) {
            state.footer = data
        },
        SET_ABOUT (state, data) {
            state.about = data
        },
        SET_PROJECTS_LIST (state, data) {
            state.projectsList = data
        },
        SET_CONTACT (state, data) {
            state.contact = data
        },
        SET_SENT_CONFIRMATION (state, data) {
            state.sentConfirmation = data
        },
        SET_PROJECTS (state, data) {
            state.projects = data
        },
        INCREMENT_CONTENTS_LOADED_COUNT (state) {
            state.contentsLoadedCount++;
        }
    }
})