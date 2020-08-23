<template>
  <div>
    <h1>
      <vue-typer :text="pageContent.title" :repeat="0"></vue-typer>
    </h1>
    <div class="terminal-alert" v-html="pageContent.body" />
    <div class="image-grid">
      <router-link v-for="project in projects" v-bind:key="project.id" :to="'/projects/' + project.slug">
        <img v-if="project.image" :src="'/projects/images/' + project.image" :alt="project.title" width="auto" height="auto">
        {{ project.title }}
      </router-link>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import ContentObject from "../Object/ContentObject";
import {ApiService, contentNames} from "../Service/ApiService";

export default {
  name: "ProjectsList",
  data() {
    return {
      projects: [],
      pageContent: new ContentObject(),
    }
  },
  mounted() {
    axios.get('/api/projects.json')
    .then(res => this.projects = res.data)
    .catch(error => console.log(error))

    ApiService
        .fetchContent(contentNames.PROJECTS)
        .then(data => this.pageContent = data)
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
