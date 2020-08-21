<template>
  <div>
    <h1>
      <vue-typer :text="data.title" :repeat="0"></vue-typer>
    </h1>
    <div>
      {{ data.body }}
    </div>
  </div>
</template>

<script>
import axios from "axios";

const CONTENT_ABOUT_NAME = 'about';

export default {
  name: "About",
  data () {
    return {
      data: {
        title: null,
        body: null,
      },
    }
  },
  mounted() {
    axios.get('/api/contents.json?name=' + CONTENT_ABOUT_NAME)
        .then(res => {
          if (undefined !== res.data[0]) this.data = res.data[0]
        })
        .catch(error => console.log(error))
  }
}
</script>

<style scoped>

</style>
