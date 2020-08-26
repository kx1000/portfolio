<template>
  <div>
    <h1>
      <vue-typer :text="about.title" :repeat="0"></vue-typer>
    </h1>
    <div>
      {{ about.body }}
    </div>
  </div>
</template>

<script>
import ContentObject from "../../Object/ContentObject";
import {mapState} from "vuex";

const CONTENT_ABOUT_NAME = 'about';

export default {
  name: "About",
  data () {
    return {
      pageContent: new ContentObject(),
    }
  },
  computed: {
    ...mapState([
      'about'
    ])
  }
}
</script>
