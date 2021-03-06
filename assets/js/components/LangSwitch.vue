<template>
  <div class="locale-changer">
    <select @change="updateContents" v-model="$i18n.locale">
      <option v-for="(lang, i) in langs" :key="`Lang${i}`" :value="lang">
        {{ lang }}
      </option>
    </select>
  </div>
</template>

<script>
import {mapActions} from "vuex";
import axios from "axios";

export default {
  data() {
    return { langs: [process.env.VUE_APP_I18N_LOCALE, process.env.VUE_APP_I18N_FALLBACK_LOCALE] }
  },
  methods: {
    ...mapActions([
        'loadAllPagesContents',
    ]),
    updateContents() {
      axios.defaults.headers.common['Accept-Language'] = this.$i18n.locale;
      this.loadAllPagesContents();
    }
  }
}
</script>

<style scoped>

</style>