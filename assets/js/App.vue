<template>
  <div class="terminal">
      <div v-if="allContentsCount === contentsLoadedCount" class="fadeIn">
        <div class="container">
          <div class="terminal-nav">
            <div class="terminal-logo">
              <div class="logo terminal-prompt animate__animated animate__zoomIn fast_animation">
                <a class="no-style" href="/">
                  {{ main.header }}
                </a>
              </div>
            </div>
            <nav class="terminal-menu">
              <ul>
                <li><dark-mode-switch /></li>
                <li><lang-switch /></li>
                <li class="animate__animated animate__zoomIn fast_animation_delay_1">
                  <router-link to="/" exact>
                    00. O mnie
                  </router-link>
                </li>
                <li class="animate__animated animate__zoomIn fast_animation_delay_2">
                  <router-link to="/projects">
                    01. Projekty
                  </router-link>
                </li>
                <li class="animate__animated animate__zoomIn fast_animation_delay_3">
                  <router-link to="/contact">
                    02. Kontakt
                  </router-link>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <div class="container">
          <hr class="animate__animated animate__fadeInLeft fast_animation_delay_5">
          <transition :name="transitionName" mode="out-in">
            <router-view></router-view>
          </transition>
          <hr class="animate__animated animate__fadeInRight fast_animation_delay_6">
          <div class="center animate__animated animate__zoomIn fast_animation_delay_4">
            <p>
              {{ main.footer }} <a :href="main.pageSource" target="_blank">kod strony</a>
            </p>
          </div>
        </div>
        <div class="right-side-container animate__animated animate__slideInUp fast_animation_delay_7">
          <div class="link">
            <a :href="'mailto:' + main.email">
              {{ main.email }}
            </a>
          </div>
          <div class="line"></div>
        </div>
        <div class="left-side-container animate__animated animate__slideInDown fast_animation_delay_8">
          <div class="line"></div>
          <div class="link">
            <a :href="'tel:' + main.phone">
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

const NEXT_TRANSITION = 'slide-left';
const PREVIOUS_TRANSITION = 'slide-right';

export default {
  name: 'app',
  components: {LangSwitch, DarkModeSwitch },
  data () {
    return {
      transitionName: NEXT_TRANSITION,
    }
  },
  methods: {
    ...mapActions([
        'loadAllPagesContents',
        'loadProjects',
        'updatePageContentsActionsCount',
    ]),
    updateNextPageTitle(to) {
      document.title = to.meta.title;
    },
    updatePageTransition(to, from) {
      const fromOrder = from.meta.order;
      const toOrder = to.meta.order;
      this.transitionName = toOrder < fromOrder ? PREVIOUS_TRANSITION : NEXT_TRANSITION
    },
  },
  watch: {
    '$route' (to, from) {
      this.updateNextPageTitle(to);
      this.updatePageTransition(to, from);
    }
  },
  mounted() {
    this.updatePageContentsActionsCount();
    this.loadAllPagesContents();
    document.title = this.$route.meta.title;
  },
  computed: {
    ...mapState(MODULE_PAGES_CONTENTS, [
        'main'
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
