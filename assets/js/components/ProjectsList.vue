<template>
  <div>
    <h1>
      <vue-typer :text="projectsList.title" :repeat="0"></vue-typer>
    </h1>
    <div class="terminal-alert" v-html="projectsList.description" />
    <div class="image-grid">
      <router-link v-for="(project, index) in projects" v-bind:key="project.id" :to="'/projects/' + project.slug" class="item hvr-float">
        <div :class="'animate__animated animate__zoomIn very_fast_animation_delay_' + index">
          <img v-if="project.image" :src="'/projects/images/' + project.image" :alt="project.title" width="auto" height="auto">
          <div class="title">
            {{ project.title }}
            <small v-if="project.year" class="text-secondary">
              //{{ project.year }}
            </small>
          </div>
        </div>
      </router-link>
    </div>
    <div v-if="projectsList.githubLink && projectsList.githubName" style="text-align: center">
      <hr>
      <a :href="projectsList.githubLink" target="_blank" class="btn btn-default">
        <span class="icon">
          <font-awesome-icon :icon="['fab', 'github']" />
        </span>
        <span>
          {{ projectsList.githubName }}
        </span>
      </a>
    </div>
  </div>
</template>

<script>
import {mapState} from "vuex";
import {MODULE_PAGES_CONTENTS} from "../store/modules/pagesContents";

export default {
  computed: {
    ...mapState(MODULE_PAGES_CONTENTS, [
      'projectsList',
      'projects',
    ])
  },
  created() {
    document.title = this.projectsList.title;
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
