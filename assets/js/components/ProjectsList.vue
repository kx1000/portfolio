<template>
  <div>
    <h1>
      <vue-typer :text="projectsList.title" :repeat="0"></vue-typer>
    </h1>
    <div class="terminal-alert" v-html="projectsList.body" />
    <div class="image-grid">
      <router-link v-for="project in projects" v-bind:key="project.id" :to="'/projects/' + project.slug" class="hvr-float">
        <img v-if="project.image" :src="'/projects/images/' + project.image" :alt="project.title" width="auto" height="auto">
        {{ project.title }}
      </router-link>
    </div>
  </div>
</template>

<script>
import {mapState} from "vuex";

export default {
  name: "ProjectsList",
  data() {
    return {
    }
  },
  computed: {
    ...mapState([
      'projectsList',
      'projects',
    ])
  }
}
</script>

<style scoped>
.image-grid {
  display: grid;
  grid-template-rows: auto;
  grid-gap: 1em;
  grid-template-columns: repeat( auto-fit, minmax(calc(var(--page-width) / 4), 1fr) );
}

.image-grid a img {
  object-fit: cover;
  height: 300px;
}
</style>
