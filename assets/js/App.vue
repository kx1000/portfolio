<template>
  <div id="app" class="terminal">
    <div class="container">
      <div class="terminal-nav">
        <div class="terminal-logo">
          <div class="logo terminal-prompt">
            <router-link class="no-style" to="/">
              {{ headerData.title }}
            </router-link>
          </div>
          {{ headerData.body }}
        </div>
        <nav class="terminal-menu">
          <ul>
            <li><dark-mode-switch /></li>
            <li><router-link to="/" exact>O mnie</router-link></li>
            <li><router-link to="/projects">Projekty</router-link></li>
            <li><router-link to="/contact">Kontakt</router-link></li>
          </ul>
        </nav>
      </div>
    </div>
    <div class="container">
      <hr>
      <transition :name="transitionName" mode="out-in">
        <router-view></router-view>
      </transition>
      <hr>
      <div class="center">
        {{ footerData.title }} <span v-html="footerData.body"/>
      </div>
    </div>
  </div>
</template>

<script>
import DarkModeSwitch from "./components/DarkModeSwitch";
import ContentObject from "./Object/ContentObject";
import {ApiService, contentNames} from "./Service/ApiService";

const NEXT_TRANSITION = 'slide-left';
const PREVIOUS_TRANSITION = 'slide-right';

export default {
  name: 'app',
  components: { DarkModeSwitch },
  data () {
    return {
      transitionName: NEXT_TRANSITION,
      footerData: new ContentObject(),
      headerData: new ContentObject(),
    }
  },
  watch: {
    '$route' (to, from) {
      const fromOrder = from.meta.order;
      const toOrder = to.meta.order;
      this.transitionName = toOrder < fromOrder ? PREVIOUS_TRANSITION : NEXT_TRANSITION
    }
  },
  mounted() {
    ApiService
        .fetchContent(contentNames.HEADER)
        .then(data => this.headerData = data)

    ApiService
        .fetchContent(contentNames.FOOTER)
        .then(data => this.footerData = data)
  }
}
</script>
