<template>
  <div>
    <div class="heading">
      <h1>Testing Auth with Cruds</h1>
      <h6>note that you cannot modify any of the cruds unless you login</h6>
    </div>
    <div class="alert alert-danger" v-if="error">
        <p>There was an error</p>
        <p>Error Code: {{errors.response.status}}</p>
    </div>
    <curd-component
      v-for="crud in cruds"
      v-bind="crud"
      :key="crud.id"
      @update="update"
      @delete="del"
    ></curd-component>
    <div>
      <button @click="create()">Add</button>
    </div>

    <loading-circle-component :is_transitioning="is_loading"></loading-circle-component>
  </div>
</template>
<script>
  function Crud({ id, color, name}) {
    this.id = id;
    this.color = color;
    this.name = name;
  }
  import LoadingCircleComponent from "../components/LoadingCircleComponent";
  import CurdComponent from '../components/CurdComponent.vue';
  export default {
    data() {
      return {
        cruds: [],
        is_loading: false,
        errors: null,
        error: false,
      }
    },
    methods: {
      async create() {
          this.is_loading = true;
          window.axios.get('/cruds/create').then(({ data }) => {
            this.cruds.push(new Crud(data));
        }).catch((response) => {
            this.error = true;
            this.errors = response;
        }).then(() => {
            this.is_loading = false;
        });
      },
      async read() {
          this.is_loading = true;
          window.axios.get('/cruds').then(({ data }) => {
            data.forEach(crud => {
              this.cruds.push(new Crud(crud));
            });
        }).catch((response) => {
            this.error = true;
            this.errors = response;
        }).then(() => {
            this.is_loading = false;
        });
      },
      async update(id, color) {
          this.is_loading = true;
          window.axios.put(`/cruds/${id}`, { color }).then(() => {
            // Once AJAX resolves we can update the Crud with the new color
            this.cruds.find(crud => crud.id === id).color = color;
            this.error = false;
        }).catch((response) => {
            this.error = true;
            this.errors = response;
        }).then(() => {
            this.is_loading = false;
        });
      },
      async del(id) {
          this.is_loading = true;
          window.axios.delete(`/cruds/${id}`).then(() => {
            let index = this.cruds.findIndex(crud => crud.id === id);
            this.cruds.splice(index, 1);
        }).catch((response) => {
            this.error = true;
            this.errors = response;
        }).then(() => {
            this.is_loading = false;
        });
      }
    },
    created() {
        this.read();
    },
    components: {
      CurdComponent,
      LoadingCircleComponent
    }
  }
</script>
