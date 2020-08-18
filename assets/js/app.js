import Vue from 'vue'
import App from './App.vue'
import VueRouter from "vue-router";
import { routes } from "./routes";

import VueTyperPlugin from 'vue-typer'

import { library } from '@fortawesome/fontawesome-svg-core'
import { fas } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

import 'terminal.css'
import '../css/app.css';

library.add(fas);
Vue.component('font-awesome-icon', FontAwesomeIcon);

Vue.use(VueRouter);
Vue.use(VueTyperPlugin);

const router = new VueRouter({routes});

new Vue({
    el: '#app',
    router,
    render: h => h(App)
})
