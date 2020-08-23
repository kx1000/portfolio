<template>
  <div>
    <h1>
      <vue-typer :text="pageContent.title" :repeat="0"></vue-typer>
    </h1>
    <div>
      {{ pageContent.body }}
    </div>
  </div>
</template>

<script>
import ContentObject from "../../Object/ContentObject";
import {ApiService, contentNames} from "../../Service/ApiService";

const CONTENT_ABOUT_NAME = 'about';

export default {
  name: "About",
  data () {
    return {
      pageContent: new ContentObject(),
    }
  },
  mounted() {
    ApiService
        .fetchContent(contentNames.ABOUT_CONTENT_NAME)
        .then(data => this.pageContent = data)
  }
}
</script>

<style scoped>

</style>
