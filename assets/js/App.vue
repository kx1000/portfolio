<template>
  <div class="terminal">
      <div v-if="allContentsCount <= contentsLoadedCount" class="fadeIn">
        <div class="container">
          <div class="terminal-nav">
            <div class="terminal-logo">
              <div class="logo terminal-prompt animate__animated animate__zoomIn fast_animation">
                <a class="no-style special-color" href="/">
                  {{ main.header }}
                </a>
              </div>
            </div>
            <nav class="terminal-menu">
              <ul>
                <li><dark-mode-switch style="margin-right: 20px"/> <lang-switch /></li>
                <li class="animate__animated animate__zoomIn fast_animation_delay_1">
                  <router-link :to="{ name: 'about', params: { 'locale': $i18n.locale } }" exact>
                    {{ about.title }}
                  </router-link>
                </li>
                <li class="animate__animated animate__zoomIn fast_animation_delay_2">
                  <router-link :to="{ name: 'projects', params: { 'locale': $i18n.locale } }">
                    {{ projectsList.title }}
                  </router-link>
                </li>
                <li class="animate__animated animate__zoomIn fast_animation_delay_3">
                  <router-link :to="{ name: 'contact', params: { 'locale': $i18n.locale } }">
                    {{ contact.title }}
                  </router-link>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <div class="container">
          <hr class="animate__animated animate__fadeInLeft fast_animation_delay_5">
          <router-view></router-view>
          <hr class="animate__animated animate__fadeInRight fast_animation_delay_6">
          <div class="center animate__animated animate__zoomIn fast_animation_delay_4">
            <p>
              {{ main.footer }} • <a :href="main.pageSource" target="_blank">{{ $t('app.footer.source') }}</a>
            </p>
          </div>
        </div>
        <div class="right-side-container animate__animated animate__slideInUp fast_animation_delay_7">
          <div class="link">
            <a class="special-color" :href="'mailto:' + main.email">
              {{ main.email }}
            </a>
          </div>
          <div class="line"></div>
        </div>
        <div class="left-side-container animate__animated animate__slideInDown fast_animation_delay_8">
          <div class="line"></div>
          <div class="link">
            <a class="special-color" :href="'tel:' + main.phone">
              {{ main.phone }}
            </a>
          </div>
        </div>
      </div>
      <div v-else>
        <div class="sk-plane"></div>
      </div>
  </div>
</template>

<script>
import DarkModeSwitch from "./components/DarkModeSwitch";
import {mapActions, mapState} from 'vuex'
import LangSwitch from "./components/LangSwitch";
import {MODULE_PAGES_CONTENTS} from "./store/modules/pagesContents";
import axios from "axios";

export default {
  name: 'app',
  components: {
    LangSwitch,
    DarkModeSwitch
  },
  methods: {
    ...mapActions([
        'loadAllPagesContents',
        'loadProjects',
    ]),
  },
  mounted() {
    axios.defaults.headers.common['Accept-Language'] = this.$i18n.locale;
    this.loadAllPagesContents();
  },
  computed: {
    ...mapState(MODULE_PAGES_CONTENTS, [
        'main',
        'about',
        'projectsList',
        'contact',
    ]),
    ...mapState([
        'contentsLoadedCount',
        'allContentsCount',
    ])
  }
}
</script>

<style scoped>
@keyframes fadeIn {
  from {opacity: 0;}
  to   {opacity: 1;}
}

.fadeIn {
  animation: fadeIn 2s;
}

.right-side-container {
  position: fixed;
  bottom: 10px;
  left: auto;
  z-index: 10;
  color: rgb(168, 178, 209);
  right: calc(50% - (850px / 2) - 100px);
  width: 40px;
}

.right-side-container > .link {
  align-items: center;
  position: relative;
  -moz-box-align: center;
  flex-direction: column;
  display: flex;
}

.right-side-container > .link > a {
  font-size: 12px;
  letter-spacing: 0.1em;
  writing-mode: vertical-rl;
  margin: 20px auto;
}

.right-side-container > .line, .left-side-container > .line {
  display: block;
  width: 1px;
  height: 100px;
  margin: 0 auto;
  #background-color: rgb(168, 178, 209);
  border-left: 1px dashed var(--secondary-color);
}

.left-side-container {
  position: fixed;
  top: 10px;
  right: auto;
  z-index: 10;
  color: rgb(168, 178, 209);
  left: calc(50% - (850px / 2) - 100px);
  width: 40px;
}

.left-side-container .link {
  align-items: center;
  position: relative;
  -moz-box-align: center;
  flex-direction: column;
  display: flex;
}

.left-side-container .link a {
  font-size: 12px;
  letter-spacing: 0.1em;
  writing-mode: vertical-rl;
  transform: rotate(180deg);
  margin: 20px auto;
}

.sk-plane {
  background-color: var(--font-color);
  position: fixed;
  margin: auto;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
}
</style>
