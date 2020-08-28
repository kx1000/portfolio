<template>
  <div id="app" class="terminal">
      <div v-if="actionsCount === contentsLoadedCount" class="animate__animated animate__zoomInDown">
        <div class="container">
          <div class="terminal-nav">
            <div class="terminal-logo">
              <div class="logo terminal-prompt">
                <router-link class="no-style" to="/">
                  {{ header.title }}
                </router-link>
              </div>
              {{ header.body }}
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
            {{ footer.title }} <span v-html="footer.body"/>
          </div>
        </div>
      </div>
      <div v-else>
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
    getLoadingProgress: function () {
      let progress = (this.contentsLoadedCount * 100) / this.actionsCount;
      return "width: " + progress + "%";
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
    this.actionsCount = Object.keys(actions).length;

    for (const action in actions) {
      this.$store.dispatch(action);
    }
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
