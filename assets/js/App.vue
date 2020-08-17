<template>
  <div id="app" class="terminal">
    <div class="container">
      <div class="terminal-nav">
        <div class="terminal-logo">
          <div class="logo terminal-prompt"><router-link class="no-style" to="/">Kacper Rogula</router-link></div>
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
        Kacper Rogula 2020 <a href="" target="_blank">źródło strony</a>
      </div>
    </div>
  </div>
</template>

<script>
import DarkModeSwitch from "./components/DarkModeSwitch";

const NEXT_TRANSITION = 'slide-left';
const PREVIOUS_TRANSITION = 'slide-right';

export default {
  name: 'app',
  components: { DarkModeSwitch },
  data () {
    return {
      transitionName: NEXT_TRANSITION,
    }
  },
  watch: {
    '$route' (to, from) {
      const fromOrder = from.meta.order;
      const toOrder = to.meta.order;
      this.transitionName = toOrder < fromOrder ? PREVIOUS_TRANSITION : NEXT_TRANSITION
    }
  }
}
</script>
