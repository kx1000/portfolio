<template>
  <div>
    <h1>
      <vue-typer text="Projekty" :repeat="0"></vue-typer>
    </h1>
    <div class="image-grid">
      <router-link v-for="project in projects" :to="'/projects/' + project.slug">
        <img v-if="project.image" :src="'/projects/images/' + project.image" :alt="project.title" width="auto" height="auto">
        {{ project.title }}
      </router-link>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: "ProjectsList",
  data() {
    return {
      projects: null,
    }
  },
  mounted() {
    axios.get('/api/projects.json')
    .then(res => this.projects = res.data)
    .catch(error => console.log(error))
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
