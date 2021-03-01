<template>
  <div class="locale-changer">
    <select v-model="$i18n.locale">
      <option v-for="(lang, i) in langs" :key="`Lang${i}`" :value="lang">
        {{ lang }}
      </option>
    </select>
  </div>
</template>

<script>
export default {
  data() {
    return { langs: [process.env.VUE_APP_I18N_LOCALE, process.env.VUE_APP_I18N_FALLBACK_LOCALE] }
  }
}
</script>

<style scoped>

</style>