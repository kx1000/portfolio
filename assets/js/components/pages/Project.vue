<template>
<div>
  <router-link to="/projects" class="back">< powrót</router-link>
  <h1>
    <vue-typer text="Projekt 1" :repeat="0"></vue-typer>
  </h1>
  <div class="project-grid">
    <div>
      <img src="/assets/img/Cakeshop-compressed.gif">
    </div>
    <div>
      Prosty system e-commerce.
      [opisać funkcje]
      [opisać panel admina]
      Projekt wykonany na potrzeby pracy inżynierskiej.
      Mój pierwszy projekt w Symfony.
    </div>
  </div>

  <h2>{{ $route.params.slug }}</h2>
</div>
</template>

<script>
export default {
  name: "Project"
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
