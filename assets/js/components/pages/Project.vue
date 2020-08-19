<template>
<div>
  <router-link to="/projects" class="back">< powrót</router-link>
  <div v-if="null !== project">
    <h1>
      <vue-typer :text="project.title" :repeat="0"></vue-typer>
    </h1>
    <div class="project-grid">
      <div>
        <img v-if="project.animation" :src="project.animation">
        <img v-else-if="project.image" :src="project.image">
      </div>
      <div>
        {{ project.body }}
      </div>
    </div>
  </div>
  <div v-else>
    :(
  </div>
</div>
</template>

<script>
import axios from 'axios'

export default {
  name: "Project",
  data() {
    return {
      project: null,
    }
  },
  mounted() {
    axios.get('/api/projects.json?slug=' + this.$route.params.slug)
        .then(res => {
          if (undefined !== res.data[0]) this.project = res.data[0]
        })
        .catch(error => console.log(error))
  }
}
</script>

<style>
.project-grid {
  align-items: center;
  display: grid;
  grid-template-rows: auto;
  display: grid;
  grid-gap: 1em;
  grid-template-rows: auto;
  grid-template-columns: repeat( auto-fit, minmax(calc(var(--page-width) / 3), 1fr) );
}

.back {
  float: right;
}
</style>
