import {apiService, contentNames} from "../../service/apiService";
import arrayToObjectConverter from "../../service/arrayToObjectConverter";

export const MODULE_PAGES_CONTENTS = 'pagesContents';

export default {
    namespaced: true,
    state: {
        main: undefined,
        about: undefined,
        projectsList: undefined,
        projects: [],
        contact: undefined,
    },
    actions: {
        loadMain({commit}) {
            apiService
                .fetchPageContents(contentNames.MAIN)
                .then(data => {
                    commit('SET_MAIN', data)
                    commit('INCREMENT_CONTENTS_LOADED_COUNT', undefined, { root: true })
                })
        },
        loadAbout({commit}) {
            apiService
                .fetchPageContents(contentNames.ABOUT)
                .then(data => {
                    commit('SET_ABOUT', data)
                    commit('INCREMENT_CONTENTS_LOADED_COUNT', undefined, { root: true })
                })
        },
        loadProjectsList({commit}) {
            apiService
                .fetchPageContents(contentNames.PROJECTS)
                .then(data => {
                    commit('SET_PROJECTS_LIST', data)
                    commit('INCREMENT_CONTENTS_LOADED_COUNT', undefined, { root: true })
                })
        },
        loadProjects({commit}) {
            apiService
                .fetchProjects()
                .then(data => {
                    commit('SET_PROJECTS', data)
                    commit('INCREMENT_CONTENTS_LOADED_COUNT', undefined, { root: true })
                })
        },
        loadContact({commit}) {
            apiService
                .fetchPageContents(contentNames.CONTACT)
                .then(data => {
                    commit('SET_CONTACT', data)
                    commit('INCREMENT_CONTENTS_LOADED_COUNT', undefined, { root: true })
                })
        },
    },
    mutations: {
        SET_MAIN (state, data) {
            state.main = arrayToObjectConverter.convert(data)
        },
        SET_ABOUT (state, data) {
            state.about = arrayToObjectConverter.convert(data)
        },
        SET_PROJECTS_LIST (state, data) {
            state.projectsList = arrayToObjectConverter.convert(data)
        },
        SET_CONTACT (state, data) {
            state.contact = arrayToObjectConverter.convert(data)
        },
        SET_PROJECTS (state, data) {
            state.projects = data
        },
    },
}