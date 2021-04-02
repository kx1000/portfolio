<template>
  <div>
    <transition :name="transitionName" mode="out-in">
      <router-view></router-view>
    </transition>
  </div>
</template>

<script>
const NEXT_TRANSITION = 'slide-left';
const PREVIOUS_TRANSITION = 'slide-right';

export default {
  data () {
    return {
      transitionName: NEXT_TRANSITION,
    }
  },
  methods: {
    updatePageTransition(to, from) {
      const fromOrder = from.meta.order;
      const toOrder = to.meta.order;
      this.transitionName = toOrder < fromOrder ? PREVIOUS_TRANSITION : NEXT_TRANSITION
    },
  },
  watch: {
    '$route' (to, from) {
      this.updatePageTransition(to, from);
    }
  },
}
</script>