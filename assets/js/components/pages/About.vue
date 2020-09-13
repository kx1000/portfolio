<template>
  <div>
    <h1>
      <vue-typer :text="about.title" :repeat="0"></vue-typer>
    </h1>
    <div v-html="about.description" class="about-grid"></div>
  </div>
</template>

<script>
import {mapState} from "vuex";

export default {
  name: "About",
  data () {
    return {
    }
  },
  computed: {
    ...mapState([
      'about'
    ])
  }
}
</script>
