<template>
  <div>
    <transition :name="transitionName" mode="out-in">
      <router-view></router-view>
    </transition>
  </div>
</template>

<script>
const TO_DEPTH_TRANSITION = 'slide-up';
const FROM_DEPTH_TRANSITION = 'slide-bottom';

export default {
  data: function () {
    return {
      transitionName: TO_DEPTH_TRANSITION,
    }
  },
  watch: {
    '$route' (to, from) {
      const toDepth = to.path.split('/').length
      const fromDepth = from.path.split('/').length
      this.transitionName = toDepth < fromDepth ? FROM_DEPTH_TRANSITION : TO_DEPTH_TRANSITION;
    }
  }
}
</script>
