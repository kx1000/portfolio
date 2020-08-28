<template>
  <div>
    <h1>
      <vue-typer :text="contact.title" :repeat="0"></vue-typer>
    </h1>
    <form v-if="false === isSent" @submit.prevent="onSubmit">
      <div v-html="contact.body" class="terminal-alert"></div>
      <div v-if="isError" class="terminal-alert terminal-alert-error">
        Nie udało się wysłać wiadomości. Wyślij wiadomość kożystając ze swojego klienta pocztowego na adres: <b>kacper.rogula@gmail.com</b>.
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
            <button class="btn btn-default" type="submit" role="button" name="send" id="submit">Wyślij</button>
          </div>
        </fieldset>
      </form>
      <div v-else>
        <div class="terminal-alert terminal-alert-primary">
          {{ sentConfirmation.body }}
        </div>
      </div>
  </div>
</template>

<script>
import axios from 'axios'
import {mapState} from "vuex";

export default {
  name: "Contact",
  data() {
    return {
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
    }
  },
  computed: {
    ...mapState([
      'contact',
      'sentConfirmation',
    ])
  }
}
</script>
