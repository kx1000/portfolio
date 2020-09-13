import Vue from 'vue'
import vuex from 'vuex'
import axios from 'axios'
import {contentNames, ApiService} from './Service/ApiService'

Vue.use(vuex, axios)

export const actions = {
    loadMain({commit}) {
        ApiService
            .fetchPageContents(contentNames.MAIN)
            .then(data => {
                commit('SET_MAIN', data)
                commit('INCREMENT_CONTENTS_LOADED_COUNT')
            })
    },
    loadAbout({commit}) {
        ApiService
            .fetchPageContents(contentNames.ABOUT)
            .then(data => {
                commit('SET_ABOUT', data)
                commit('INCREMENT_CONTENTS_LOADED_COUNT')
            })
    },
    loadProjectsList({commit}) {
        ApiService
            .fetchPageContents(contentNames.PROJECTS)
            .then(data => {
                commit('SET_PROJECTS_LIST', data)
                commit('INCREMENT_CONTENTS_LOADED_COUNT')
            })
    },
    loadContact({commit}) {
        ApiService
            .fetchPageContents(contentNames.CONTACT)
            .then(data => {
                commit('SET_CONTACT', data)
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

const convertToObject = data => {
    let contents = {};
    data.contents.forEach((content) => {
        contents[content.name] = content.value;
    });
    return contents;
}

export default new vuex.Store({
    state: {
        contentsLoadedCount: 0,
        main: '',
        about: '',
        projectsList: '',
        contact: '',
        projects: [],
    },
    actions: actions,
    mutations: {
        SET_MAIN (state, data) {
            state.main = convertToObject(data)
        },
        SET_ABOUT (state, data) {
            state.about = convertToObject(data)
        },
        SET_PROJECTS_LIST (state, data) {
            state.projectsList = convertToObject(data)
        },
        SET_CONTACT (state, data) {
            state.contact = convertToObject(data)
        },
        SET_SENT_CONFIRMATION (state, data) {
            state.sentConfirmation = convertToObject(data)
        },
        SET_PROJECTS (state, data) {
            state.projects = data
        },
        INCREMENT_CONTENTS_LOADED_COUNT (state) {
            state.contentsLoadedCount++;
        }
    }
})