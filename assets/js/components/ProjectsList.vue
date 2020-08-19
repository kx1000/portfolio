<template>
  <div>
    <h1>
      <vue-typer text="Projekty" :repeat="0"></vue-typer>
    </h1>
    <div v-for="project in projects" class="image-grid">
      <router-link :to="'/projects/' + project.slug">
        <img v-if="project.image" :src="project.image" :alt="project.title" width="auto" height="auto">
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
