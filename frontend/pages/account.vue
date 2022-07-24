<template>
  <div>
    <v-row>
      <v-col cols="6" offset="3">

        <v-form
          ref="form"
          lazy-validation
        >
          <v-text-field
            v-model="form.title"
            label="Название"
            required
          ></v-text-field>

          <v-file-input
            accept="image/*"
            prepend-icon="mdi-camera"
            label="Изображение"
            @change="onFileChange"
          ></v-file-input>
          <v-row
            justify="end"
          >
            <v-btn
              type="reset"
              color="error"
              class="mr-4"
            >
              Очистить
            </v-btn>
            <v-btn
              color="success"
              class="mr-4"
              @click="onSubmit"
            >
              Отправить
            </v-btn>
          </v-row>
        </v-form>

      </v-col>
    </v-row>
    <template>
      <div class="text-center ma-2">
        <v-snackbar
          right
          v-model="snackbar"
        >
          Сохранено!
          <template v-slot:action="{ attrs }">
            <v-btn
              color="pink"
              text
              v-bind="attrs"
              @click="snackbar = false"
            >
              Закрыть
            </v-btn>
          </template>
        </v-snackbar>
      </div>
    </template>
  </div>

</template>

<script>
import {mapActions} from "vuex";

export default {
  name: "account",
  middleware: 'auth',
  data() {
    return {
      snackbar: false,
      form: {
        title: '',
        image: ''
      }
    }
  },
  methods: {
    ...mapActions({
      adsStorage: 'ads/store'
    }),
    onSubmit() {
      let form = this.form
      let formData = new FormData()
      for (let key in form) {
        formData.set(key, form[key])
      }
      this.adsStorage(formData)
        .then(() => {
            this.snackbar = true
          this.$refs['form'].reset()
            setTimeout(() => this.snackbar = false, 2000)
        });
    },
    onFileChange(file) {
      this.form.image = file
    },

  },
}
</script>

<style scoped>

</style>
