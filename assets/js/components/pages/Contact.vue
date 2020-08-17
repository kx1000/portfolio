<template>
  <div>
    <h1>
      <vue-typer text="Kontakt" :repeat="0"></vue-typer>
    </h1>
    <form action="#">
        <fieldset>
          <legend>Form legend</legend>
          <div class="form-group">
            <label for="email">Email input:</label>
            <input id="email" name="email" type="email" required="" minlength="5" placeholder="test">
          </div>
          <div class="form-group">
            <label for="tarea">Textarea:</label>
            <textarea id="tarea" cols="30" rows="5" name="=&quot;tarea&quot;">Textarea text</textarea>
          </div>
          <div class="form-group">
            <label for="check">Checkbox input:</label>
            <input for="check" type="checkbox" id="check">
          </div>
          <div class="form-group">
            <button class="btn btn-default" type="submit" role="button" name="submit" id="submit">Submit</button>
          </div>
        </fieldset>
      </form>
  </div>
</template>

<script>
export default {
  name: "Contact"
}
</script>

<style scoped>

</style>
