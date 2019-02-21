<template>
  <div class="container overlay_container">
      <b-card-group deck>
          <b-card
            v-for="project in projects"
            :key="project.id"
            :title="project['title']"
            :img-src="project['img_url']"
            img-alt="Image"
            img-top
            tag="article"
            style="max-width: 20rem;color: black;"
            class="mb-2">
                <p class="card-text" style="
                  max-height:30vh;
                  overflow-y: auto;
                ">
                  {{project['description']}}
                </p>
                <em slot="footer">
                    <b-button :href="project['link_to']" variant="primary">{{project["link_desc"]}}</b-button>
                </em>
          </b-card>
      </b-card-group deck>
  </div>
</template>

<script>
export default {
  data() {
    return  {
      projects: []
    }
  },
  methods: {
      async read() {
          this.is_loading = true;
          window.axios.get('/projects').then(({ data }) => {
            data.forEach(project => {
              this.projects.push(project);
            });
        }).catch((response) => {
            this.error();
        }).then(() => {
            this.is_loading = false;
        });
      },
    error() {
      this.cards.push({
            "title": "OOPS",
            "img_url": "https://picsum.photos/200/200/?random",
            "description": "Something went very wrong with the DB, pls send help",
            "link_to": "/",
            "link_desc": "Go Home"
      });
    }
  },
  created() {
      this.read();
  },
}
</script>
<style lang="scss" scoped>
.overlay_container {
    height:80%;
    width:100%;
    padding-top:20%;

    @media screen and (min-width: 650px) {
        padding-top:10%;
    }
    @media screen and (min-width: 1024px) {
        padding-top:5%;
    }
}

</style>
