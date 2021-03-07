<template>
  <div>
    <h1>
      <vue-typer :text="contact.title" :repeat="0"></vue-typer>
    </h1>
    <form v-if="false === isSent" @submit.prevent="onSubmit">
      <div v-html="contact.description" class="terminal-alert"></div>
      <div v-if="isError" class="terminal-alert terminal-alert-error">
        {{ $t('contact.error') }} <b>{{ main.email }}</b>.
      </div>
      <fieldset>
          <legend>Formularz kontaktowy</legend>
          <div class="form-group">
            <label for="email">Email:</label>
            <input v-model="data.email" id="email" name="email" type="email" minlength="5" required>
          </div>
          <div class="form-group">
            <label for="title">Tytuł:</label>
            <input v-model="data.title" id="title" type="text" name="title">
          </div>
          <div class="form-group">
            <label for="tarea">Treść:</label>
            <textarea v-model="data.body" id="tarea" cols="30" rows="5" name="body" required></textarea>
          </div>
          <div class="form-group">
            <button v-if="isSending" class="btn btn-default" disabled>
              <span class="loader"></span>
            </button>
            <button v-else class="btn btn-default" type="submit" role="button" name="send" id="submit">
              <span class="icon">
                <font-awesome-icon icon="paper-plane" />
              </span>
              <span>
                {{ $t('contact.send') }}
              </span>
            </button>
          </div>
        </fieldset>
      </form>
      <div v-else class="animate__animated animate__tada">
        <div class="terminal-alert terminal-alert-primary">
          {{ contact.sentConfirmation }}
        </div>
      </div>
  </div>
</template>

<script>
import axios from 'axios'
import {mapState} from "vuex";
import {MODULE_PAGES_CONTENTS} from "../../store/modules/pagesContents";

export default {
  data() {
    return {
      isSending: false,
      isSent: false,
      isError: false,
      data: {
        email: null,
        title: null,
        body: null,
      },
    }
  },
  methods: {
    onSubmit() {
      this.isSending = true;
      axios.post('/api/messages.json', this.data)
        .then(res => {
          if (201 === res.status) {
            this.isSent = true
          } else {
            this.isError = true;
          }
        })
        .catch(error => {
          this.isError = true;
          console.log(error);
        })
        .finally(() => this.isSending = false)
    }
  },
  computed: {
    ...mapState(MODULE_PAGES_CONTENTS, [
      'contact',
      'main',
    ])
  },
  created() {
    document.title = this.contact.title;
  }
}
</script>