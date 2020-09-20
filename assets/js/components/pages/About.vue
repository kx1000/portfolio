<template>
  <div>
    <h1>
      <vue-typer :text="about.title" :repeat="0"></vue-typer>
    </h1>
    <div class="about-grid">
      <div>
        <img :src="about.image" class="animate__animated animate__zoomIn" style="--animate-duration: .4s;" />
      </div>
      <div>
        <p class="hello">{{ about.welcome }}</p>
        <nl2br tag="p" :text="about.description" />
        <a :href="about.cv" class="btn btn-default" target="_blank">
          Pobierz moje CV
        </a>
      </div>
    </div>
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
