<template>
  <a class="btn btn-default btn-ghost" @click="changeAppLocale">
    <img :src="'/images/flags/' + oppositeLocale + '.svg'" height="14"/>
  </a>
</template>

<script>
import {mapActions} from "vuex";
import axios from "axios";

export default {
  data() {
    return {
      langs: [
        process.env.I18N_LOCALE,
        process.env.I18N_FALLBACK_LOCALE,
      ]
    }
  },
  methods: {
    ...mapActions([
        'loadAllPagesContents',
    ]),
    changeAppLocale() {
      this.$i18n.locale = this.oppositeLocale;
      axios.defaults.headers.common['Accept-Language'] = this.$i18n.locale;
      this.loadAllPagesContents();
      this.$route.params.locale = this.$i18n.locale;
      this.$router.push(this.$route);
    }
  },
  computed: {
    oppositeLocale() {
      if (process.env.I18N_LOCALE === this.$i18n.locale) {
        return process.env.I18N_FALLBACK_LOCALE;
      }

      return process.env.I18N_LOCALE;
    }
  }
}
</script>

<style scoped>

</style>