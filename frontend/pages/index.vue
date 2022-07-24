<template>
  <div>
    <div v-if="ads.data && ads.data.length">
      <v-row>
        <v-col cols="12" md="6" lg="3" v-for="(item, key) in ads.data" :key="key">
          <v-card
            class="mx-auto"
            max-width="344"
          >
            <v-img
              :src="getFileUrl(item.image)"
              height="200px"
            ></v-img>

            <v-card-title>
              {{ item.title }}
            </v-card-title>
            <v-expand-transition>
            </v-expand-transition>
          </v-card>
        </v-col>
      </v-row>
      <div class="text-center py-6">
        <pagination-component v-bind="ads" @go="paginate"></pagination-component>
      </div>
    </div>
    <v-row v-else>
      <v-col>
        <v-alert type="error">Объявления отсутствуют!</v-alert>
      </v-col>
    </v-row>

  </div>

</template>

<script>
import {mapActions} from "vuex";
import PaginationComponent from "~/components/PaginationComponent";

export default {
  components: {PaginationComponent},
  name: 'IndexPage',
  data() {
    return {
      ads: [],
    }
  },
  async fetch() {
    this.ads = await this.adsIndex()
  },
  methods: {
    ...mapActions({
      'adsIndex': 'ads/index'
    }),
    getFileUrl(path) {
      return process.env.SERVER_BASE_URL + path
    },
    paginate(page) {
      this.adsIndex({page})
        .then(response => {
          this.ads = response
        })
    }
  },
}
</script>
