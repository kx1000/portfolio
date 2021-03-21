<template>
<div>
  <router-link :to="{ name: 'projects', params: { locale: $i18n.locale } }" class="back">
    <font-awesome-icon icon="chevron-left" /> {{ $t('shared.back') }}
  </router-link>
  <div v-if="null !== project">
    <h1>
      <vue-typer :text="title" :repeat="0"></vue-typer>
    </h1>
    <div class="project-grid">
      <div class="image-container animate__animated animate__zoomIn fast_animation">
        <img @click="showImageModal" :src="imageUrl" class="hvr-float">
      </div>
      <div>
        <div class="technologies">
          <blockquote>
            <div v-for="technology in project.technologies">
              {{ technology.name }}
            </div>
          </blockquote>
        </div>
        <div v-html="project.body"></div>
        <div class="links">
          <a v-for="link in project.links" :href="link.url" target="_blank">
            <font-awesome-icon :icon="getLinkIcon(link.icon)" /> {{ link.title }}
          </a>
        </div>
      </div>
    </div>
  </div>
  <div v-else>
    :(
  </div>
  <vue-easy-lightbox
      moveDisabled
      :visible="imgModalVisible"
      :imgs="imageUrl"
      @hide="handleHideModal"
  ></vue-easy-lightbox>
</div>
</template>

<script>
import {mapState} from "vuex";
import VueEasyLightbox from 'vue-easy-lightbox'
import {MODULE_PAGES_CONTENTS} from "../../store/modules/pagesContents";

const ANIMATIONS_PATH = '/projects/animations/';
const IMAGES_PATH = '/projects/images/';
const DEFAULT_LINK_ICON = 'link';

export default {
  components: {
    VueEasyLightbox
  },
  data() {
    return {
      project: null,
      imgModalVisible: false,
    }
  },
  methods: {
    getLinkIcon(icon) {
      if (null === icon) {
        return DEFAULT_LINK_ICON;
      }
      let fontawesomeFormatArr = icon.split(" ");
      return [fontawesomeFormatArr[0], fontawesomeFormatArr[1]];
    },
    showImageModal() {
      this.imgModalVisible = true;
    },
    handleHideModal() {
      this.imgModalVisible = false;
    },
    getCurrentProject() {
      let result;
      this.projects.forEach((project) => {
        if (this.$route.params.slug === project.slug) {
          result = project;
        }
      });

      return result;
    },
    updatePageTitle() {
      document.title = this.project.title;
    }
  },
  mounted() {
    this.project = this.getCurrentProject();
    this.updatePageTitle();
  },
  watch: {
    projects () {
      this.project = this.getCurrentProject();
    },
  },
  computed: {
    ...mapState(MODULE_PAGES_CONTENTS, [
      'projects',
    ]),
    title() {
      let title = this.project.title;

      if (this.project.subtitle) {
        title += ' ∙ ' + this.project.subtitle;
      }

      if (this.project.year) {
        title += ' ∙ ' + this.project.year;
      }

      return title;
    },
    imageUrl() {
      if (this.project.animation || this.project.image) {
        if (this.project.animation) {
          return ANIMATIONS_PATH + this.project.animation;
        }

        return IMAGES_PATH + this.project.image;
      }

      return null;
    },
  }
}
</script>

<style scoped>
.project-grid {
  height: 100%;
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
  max-width: 100%;
  object-fit: contain;
}

.image-container img:hover {
  cursor: pointer;
}

.links {
  margin-top: 10px;
}

.technologies blockquote div {
  font-style: italic;
  color: #629755;
}

.technologies blockquote::after {
  content: "*";
  color: #629755;
}
</style>
