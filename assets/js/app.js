import Vue from 'vue'
import App from './App.vue'
import VueRouter from "vue-router"
import { routes } from "./routes"
import store from "./store";

import VueTyperPlugin from 'vue-typer'
import Lightbox from 'vue-easy-lightbox'

import { library } from '@fortawesome/fontawesome-svg-core'
import { fab } from '@fortawesome/free-brands-svg-icons'
import { fas } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

import 'terminal.css'
import 'animate.css'
import 'hover.css'
import 'spinkit/spinkit.min.css'
import '../css/app.scss'

library.add(fas);
library.add(fab)
Vue.component('font-awesome-icon', FontAwesomeIcon);

Vue.use(VueRouter);
Vue.use(VueTyperPlugin);
Vue.use(Lightbox)

const router = new VueRouter({routes});

new Vue({
    el: '#app',
    router,
    store,
    render: h => h(App)
})
