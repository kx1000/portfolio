<template>
  <div>
    <h1>
      <vue-typer :text="projectsList.title" :repeat="0"></vue-typer>
    </h1>
    <div class="terminal-alert" v-html="projectsList.body" />
    <div class="image-grid">
      <router-link v-for="project in projects" v-bind:key="project.id" :to="'/projects/' + project.slug">
        <img v-if="project.image" :src="'/projects/images/' + project.image" :alt="project.title" width="auto" height="auto">
        {{ project.title }}
      </router-link>
    </div>
  </div>
</template>

<script>
import ContentObject from "../Object/ContentObject";
import {mapState} from "vuex";

export default {
  name: "ProjectsList",
  data() {
    return {
      pageContent: new ContentObject(),
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
  grid-template-columns: repeat( auto-fit, minmax(calc(var(--page-width) / 12), 1fr) );
}
</style>
