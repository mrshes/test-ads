<template>
  <v-app>
    <div fluid>
      <v-app-bar
        color="blue"
        elevation="4"
      >
        <NuxtLink to="/" class="white--text font-weight-bold text-decoration-none" >ADS</NuxtLink>
        <v-spacer></v-spacer>
        <div class="text-right">
          <v-menu
            bottom
            left
          >
            <template v-slot:activator="{ on, attrs }">
              <v-btn
                dark
                icon
                v-bind="attrs"
                v-on="on"
              >
                <v-icon
                  large
                >
                  mdi-account-circle
                </v-icon>
              </v-btn>
            </template>

            <v-list v-if="!$auth.loggedIn">
              <v-list-item @click="dialog = true">
                <v-list-item-title>Войти</v-list-item-title>
              </v-list-item>
              <v-list-item @click="dialogReg = true">
                <v-list-item-title >Регистрация</v-list-item-title>
              </v-list-item>
            </v-list>

            <v-list v-else>
              <v-list-item to="account">
                <v-list-item-title>Профиль</v-list-item-title>
              </v-list-item>
              <v-list-item @click="dispLogout">
                <v-list-item-title >Выход</v-list-item-title>
              </v-list-item>
            </v-list>

          </v-menu>
        </div>
      </v-app-bar>
    </div>
    <div v-if="!$auth.loggedIn">
      <!--    Авторизация-->
      <v-dialog
        v-model="dialog"
        max-width="600px"
      >
        <v-card>
          <v-card-title>
            <span class="text-h5">Войти</span>
          </v-card-title>
          <v-card-text>
            <v-container>
              <v-row>
                <v-col cols="12">
                  <v-text-field
                    label="Email*"
                    v-model="formLogin.email"
                    required
                  ></v-text-field>
                </v-col>

                <v-col cols="12">
                  <v-text-field
                    v-model="formLogin.password"
                    label="Password*"
                    type="password"
                    required
                  ></v-text-field>
                </v-col>
              </v-row>
            </v-container>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
              color="blue darken-1"
              text
              @click="dialog = false"
            >
              Закрыть
            </v-btn>
            <v-btn
              color="green darken-1"
              text
              @click="onLogin"
            >
              Войти
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
      <!--Регистрация-->
      <v-dialog
        v-model="dialogReg"
        max-width="600px"
      >
        <v-card>
          <v-card-title>
            <span class="text-h5">Регистрация</span>
          </v-card-title>
          <v-card-text>
            <v-container>
              <v-row>
                <v-col cols="12">
                  <v-text-field
                    label="Имя*"
                    required
                    v-model="formRegister.name"
                  ></v-text-field>
                </v-col>
                <v-col cols="12">
                  <v-text-field
                    label="Email*"
                    required
                    v-model="formRegister.email"
                  ></v-text-field>
                </v-col>

                <v-col cols="12">
                  <v-text-field
                    label="Пароль*"
                    type="password"
                    v-model="formRegister.password"
                    required
                  ></v-text-field>
                </v-col>

                <v-col cols="12">
                  <v-text-field
                    label="Подтвердите пароль*"
                    type="password"
                    v-model="formRegister.password_confirmation"
                    required
                  ></v-text-field>
                </v-col>
              </v-row>
            </v-container>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
              color="blue darken-1"
              text
              @click="dialogReg = false"
            >
              Закрыть
            </v-btn>
            <v-btn
              color="green darken-1"
              text
              @click="onRegister"
            >
              Регистрация
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </div>

    <v-container fluid>
      <Nuxt/>
    </v-container>

  </v-app>
</template>

<script>
import {mapActions} from 'vuex'

export default {
  name: 'DefaultLayout',
  data() {
    return {
      dialog: false,
      dialogReg: false,
      formLogin: {
        email: '',
        password: '',
      },
      formRegister: {
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
      }
    }
  },
  methods: {
    ...mapActions({
      'dispRegister': 'authentication/register',
      'dispLogin': 'authentication/login',
      'dispLogout': 'authentication/logout',
    }),

    onLogin(){
      this.dispLogin(this.formLogin)
    },
    onRegister(){
      this.dispRegister(this.formRegister).then((response)=> {
        console.log('208|default.vue', response,response.access_token)
        this.$auth.setUserToken(response.data.access_token)
        this.dialogReg = false
      })
    }
  },
}
</script>
