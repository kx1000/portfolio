<template>
  <a class="btn btn-default btn-ghost" @click="toggleDarkClass">
    <font-awesome-icon icon="adjust" />
  </a>
</template>

<script>
export default {
  name: "DarkModeSwitch",
  methods: {
    toggleDarkClass() {
      document.body.classList.toggle("dark");
    }
  }
}
</script>
