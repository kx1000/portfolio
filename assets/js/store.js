import Vue from 'vue'
import vuex from 'vuex'
import axios from 'axios'
import {contentNames, ApiService} from './Service/ApiService'

Vue.use(vuex, axios)

export default new vuex.Store({
    state: {
        header: '',
        footer: '',
        about: '',
        projectsList: '',
        contact: '',
        sentConfirmation: '',
        projects: [],
    },
    actions: {
        loadHeader({commit}) {
            ApiService
                .fetchContent(contentNames.HEADER)
                .then(data => commit('SET_HEADER', data))
        },
        loadFooter({commit}) {
            ApiService
                .fetchContent(contentNames.FOOTER)
                .then(data => commit('SET_FOOTER', data))
        },
        loadAbout({commit}) {
            ApiService
                .fetchContent(contentNames.ABOUT)
                .then(data => commit('SET_ABOUT', data))
        },
        loadProjectsList({commit}) {
            ApiService
                .fetchContent(contentNames.PROJECTS)
                .then(data => commit('SET_PROJECTS_LIST', data))
        }
    },
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
        }

    }
})