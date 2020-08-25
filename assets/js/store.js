import Vue from 'vue'
import vuex from 'vuex'
import axios from 'axios'
import {contentNames, ApiService} from './Service/ApiService'

Vue.use(vuex, axios)

export default new vuex.Store({
    state: {
        header: '',
        footer: '',
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
        }
    },
    mutations: {
        SET_HEADER (state, data) {
            state.header = data
        },
        SET_FOOTER (state, data) {
            state.footer = data
        }
    }
})