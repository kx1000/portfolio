<template>
<div>
  <router-link to="/projects" class="back">< powrót</router-link>
  <div v-if="null !== project">
    <h1>
      <vue-typer :text="project.title" :repeat="0"></vue-typer>
    </h1>
    <div class="project-grid">
      <div class="image-container">
        <img v-if="project.animation" :src="'/projects/animations/' + project.animation">
        <img v-else-if="project.image" :src="'/projects/images/' + project.image">
      </div>
      <div v-html="project.body"></div>
    </div>
  </div>
  <div v-else>
    :(
  </div>
</div>
</template>

<script>
import {mapState} from "vuex";

export default {
  name: "Project",
  data() {
    return {
      project: null,
    }
  },
  methods: {
    getCurrentProject() {
      let result;
      this.projects.forEach((project) => {
        if (this.$route.params.slug === project.slug) {
          result = project;
        }
      });

      return result;
    }
  },
  mounted() {
    this.project = this.getCurrentProject();
  },
  computed: {
    ...mapState([
      'projects',
    ])
  }
}
</script>

<style scoped>
.project-grid {
  align-items: center;
  display: grid;
  grid-template-rows: auto;
  grid-gap: 1em;
  grid-template-columns: repeat( auto-fit, minmax(calc(var(--page-width) / 3), 1fr) );
}

.back {
  float: right;
}

.image-container {
  text-align: center;
}

.image-container img {
  max-height: 400px;
  width: auto;
}
</style>
