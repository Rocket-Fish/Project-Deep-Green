<template>
  <div>
    <div class="heading">
      <h1>Cruds</h1>
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
      }
    },
    methods: {
      create() {
          window.axios.get('/api/cruds/create').then(({ data }) => {
            this.cruds.push(new Crud(data));
          });
      },
      read() {
          window.axios.get('/api/cruds').then(({ data }) => {
            data.forEach(crud => {
              this.cruds.push(new Crud(crud));
            });
          });
      },
      update(id, color) {
          this.is_loading = true;
          window.axios.put(`/api/cruds/${id}`, { color }).then(() => {
            // Once AJAX resolves we can update the Crud with the new color
            this.cruds.find(crud => crud.id === id).color = color;
            this.is_loading = false;
          });
      },
      del(id) {
          window.axios.delete(`/api/cruds/${id}`).then(() => {
            let index = this.cruds.findIndex(crud => crud.id === id);
            this.cruds.splice(index, 1);
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
