<template>
  <div class="terminal">
      <div v-if="actionsCount === contentsLoadedCount" class="fadeIn">
        <div class="container">
          <div class="terminal-nav">
            <div class="terminal-logo">
              <div class="logo terminal-prompt animate__animated animate__zoomIn" style="--animate-duration: .3s;">
                <a class="no-style" href="/">
                  {{ header.title }}
                </a>
              </div>
              {{ header.body }}
            </div>
            <nav class="terminal-menu">
              <ul>
                <li><dark-mode-switch /></li>
                <li class="animate__animated animate__zoomIn animate__delay-1s" style="--animate-delay: .3s; --animate-duration: .3s;">
                  <router-link to="/" exact>
                    00. O mnie
                  </router-link>
                </li>
                <li class="animate__animated animate__zoomIn animate__delay-1s" style="--animate-delay: .6s; --animate-duration: .3s;">
                  <router-link to="/projects">
                    01. Projekty
                  </router-link>
                </li>
                <li class="animate__animated animate__zoomIn animate__delay-1s" style="--animate-delay: .9s; --animate-duration: .3s;">
                  <router-link to="/contact">
                    02. Kontakt
                  </router-link>
                </li>
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
            <p>
              {{ footer.title }} <span v-html="footer.body"/>
            </p>
          </div>
        </div>
        <div class="right-side-container">
          <div class="link">
            <a href="mailto:kacper.rogula@gmail.com">
              kacper.rogula@gmail.com
            </a>
          </div>
          <div class="line"></div>
        </div>
        <div class="left-side-container">
          <div class="line"></div>
          <div class="link">
            <a href="tel:+48574189841">
              +48 574 189 841
            </a>
          </div>
        </div>
      </div>
      <div v-else>
        <div class="sk-plane"></div>
        <div class="progress-bar progress-bar-no-arrow">
          <div class="progress-bar-filled" :style="getLoadingProgress()"></div>
        </div>
      </div>
  </div>
</template>

<script>
import DarkModeSwitch from "./components/DarkModeSwitch";
import {mapState} from 'vuex'
import {actions} from "./store";

const NEXT_TRANSITION = 'slide-left';
const PREVIOUS_TRANSITION = 'slide-right';

export default {
  name: 'app',
  components: { DarkModeSwitch },
  data () {
    return {
      actionsCount: null,
      transitionName: NEXT_TRANSITION,
    }
  },
  methods: {
    updateNextPageTitle(to) {
      document.title = to.meta.title;
    },
    updatePageTransition(to, from) {
      const fromOrder = from.meta.order;
      const toOrder = to.meta.order;
      this.transitionName = toOrder < fromOrder ? PREVIOUS_TRANSITION : NEXT_TRANSITION
    },
    getLoadingProgress: function () {
      let progress = (this.contentsLoadedCount * 100) / this.actionsCount;
      return "width: " + progress + "%";
    },
    fetchDataFromApi() {
      for (const action in actions) {
        this.$store.dispatch(action);
      }
    },
    updateStoreActionsCount() {
      this.actionsCount = Object.keys(actions).length;
    },
  },
  watch: {
    '$route' (to, from) {
      this.updateNextPageTitle(to);
      this.updatePageTransition(to, from);
    }
  },
  mounted() {
    this.updateStoreActionsCount();
    this.fetchDataFromApi();

    document.title = this.$route.meta.title;
  },
  computed: {
    ...mapState([
        'header',
        'footer',
        'contentsLoadedCount'
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
  animation: fadeIn .6s ease-out;
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
  writing-mode: sideways-lr;
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
