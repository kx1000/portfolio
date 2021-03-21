<template>
  <a class="btn btn-default btn-ghost" @click="changeAppLocale">
    <span v-if="areContentsReloading" class="loader"></span>
    <img v-else :src="'/images/flags/' + oppositeLocale + '.svg'" height="14" :alt="oppositeLocale" />
  </a>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
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
    ...mapGetters([
        'areContentsReloading',
    ]),
    oppositeLocale() {
      if (process.env.I18N_LOCALE === this.$i18n.locale) {
        return process.env.I18N_FALLBACK_LOCALE;
      }

      return process.env.I18N_LOCALE;
    }
  }
}
</script>