<template>
<div>
  <router-link to="/projects">< powrót</router-link>
  <h1>
    <vue-typer text="Projekt 1" :repeat="0"></vue-typer>
  </h1>
  :)
  <h2>{{ $route.params.slug }}</h2>
</div>
</template>

<script>
export default {
  name: "Project"
}
</script>
