<template>
  <div>
    <h1>
      <vue-typer :text="about.title" :repeat="0"></vue-typer>
    </h1>
    <div class="about-grid">
      <div>
        <img :src="about.image" class="animate__animated animate__zoomIn" style="--animate-duration: .4s;" />
      </div>
      <div>
        <p class="hello">{{ about.welcome }}</p>
        <nl2br tag="p" :text="about.description" />
        <a :href="about.linkedin" class="btn btn-default" target="_blank">
          <span class="icon">
            <font-awesome-icon :icon="['fab', 'linkedin']" />
          </span>
          <span>
            {{ $t('about.linkedin') }}
          </span>
        </a>
      </div>
    </div>
    <br>
  </div>
</template>

<script>
import {mapState} from "vuex";
import {MODULE_PAGES_CONTENTS} from "../../store/modules/pagesContents";

export default {
  computed: {
    ...mapState(MODULE_PAGES_CONTENTS, [
      'about'
    ])
  },
  created() {
    document.title = this.about.title;
  }
}
</script>
