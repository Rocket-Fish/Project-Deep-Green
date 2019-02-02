<template>
    <div>
        <bg-component :child_component="getComponent()"></bg-component>
    </div>
</template>
<script>
    import ProjectsComponent from '../components/ProjectsComponent';
    export default {
        components: {
            'projects-component':ProjectsComponent,
        },
        methods: {
            getComponent() {
                return ProjectsComponent;
            }
        }
    }
</script>
