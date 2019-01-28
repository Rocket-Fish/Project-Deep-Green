<template>
  <div style="height:100%; width100%; overflow-y: auto;">
    <div class="twenty-top col-lg-12" >
      <b-row>
        <b-col lg="4"
          v-for="card in cards"
          :key="card.id">
          <b-card
            :title="card['title']"
            :img-src="card['img_url']"
            img-alt="Image"
            img-top
            tag="article"
            style="max-width: 20rem;color: black;"
            class="mb-2">
            <p class="card-text" style="
              max-height:30vh;
              overflow-y: auto;
            ">
              {{card['description']}}
            </p>
            <b-button :href="card['link_to']" variant="primary">{{card["link_desc"]}}</b-button>
          </b-card>
        </b-col>
      </b-row>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return  {
      cards: []
    }
  },
  methods: {
    exportData(data) {
      this.cards = data.body;
      if(data.body.length<1) {
        this.error(data);
      }
    },
    error(data) {
      this.cards.push({
            "title": "OOPS",
            "img_url": "https://picsum.photos/200/300/?random",
            "description": "Something went very wrong with the DB, pls send help",
            "link_to": "/",
            "link_desc": "Go Home"
      });
    }
  },
  created() {
    this.$http.get('projects').then(this.exportData, this.error);
  },
  http: {
    root: '/api/',
  }
}
</script>
<style scoped>
</style>
