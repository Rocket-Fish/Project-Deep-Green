<template>
    <div>
        <b-form @submit="onSubmit" v-if="show">
            <pfgc
                :id="'title'"
                :label="'Title'"
                :label-for="'title'"
                :description="'Title of project'"
                :type="'text'"
                :value="form.title"
                @input="form.title = $event"
                ></pfgc>
            <pfgc
                :id="'img_url'"
                :label="'IMG URL'"
                :label-for="'img_url'"
                :description="'Showcase Image URL'"
                :type="'text'"
                :value="form.img_url"
                @input="form.img_url = $event"
                ></pfgc>
            <pfgc
                :id="'description'"
                :label="'Description'"
                :label-for="'description'"
                :description="'Description'"
                :type="'text'"
                :value="form.description"
                @input="form.description = $event"
                ></pfgc>
            <pfgc
                :id="'link_to'"
                :label="'Link to Project Showcase'"
                :label-for="'link_to'"
                :description="'URL to to an external site'"
                :type="'text'"
                :value="form.link_to"
                @input="form.link_to = $event"
                ></pfgc>
            <pfgc
                :id="'link_desc'"
                :label="'Description of location'"
                :label-for="'link_desc'"
                :description="'example: GITHUB'"
                :type="'text'"
                :value="form.link_desc"
                @input="form.link_desc = $event"
                ></pfgc>
            <b-button type="submit" variant="primary">Submit</b-button>
        </b-form>
        {{error}}
    </div>
</template>
<script>
    import ProjectFormGroupComponent from '../components/ProjectFormGroupComponent'

    export default {
        data() {
            return {
                form: {
                  id: null,
                  title: 'Something went Wrong!',
                  img_url: 'img URL goes here',
                  description: '',
                  link_to: 'Some URL goes here',
                  link_desc: '',
                },
                show: false,
                error: "",
            }
        },
        methods: {
            async onSubmit(evt) {
                evt.preventDefault();
                this.is_loading = true;
                window.axios.put(`/projects/${this.form.id}`, this.form).then(() => {
                    this.$router.push({name: 'projects'})
              }).catch((response) => {
                  // error handling here
                  this.error = response;
              }).then(() => {
                  this.is_loading = false;
              });

            },
            async read() {
                this.is_loading = true;
                window.axios.get(`/projects/${this.$route.params.id}`).then(({ data }) => {
                  this.form.id = data['id'];
                  this.form.title = data['title'];
                  this.form.img_url = data['img_url'];
                  this.form.description = data['description'];
                  this.form.link_to = data['link_to'];
                  this.form.link_desc = data['link_desc'];
                  // this is important, because otherwise
                  // the form will be created before we can finish
                  // loading and the displayed message will be messed up
                  this.show = true;
              }).catch((response) => {
                  this.error();
              }).then(() => {
                  this.is_loading = false;
              });
            },
            error() {
                // currently does nothing
            }
        },
        created() {
            this.read();
        },
        components: {
            pfgc: ProjectFormGroupComponent
        }
    }
</script>
<style>

</style>
