<template>
    <div>
        <bubble-component :child_component='getComponent()'></bubble-component>

    </div>
</template>
<script>
    import ProjectsComponent from '../components/ProjectsComponent';
    import BubbleBGComponent from '../components/BubbleBGComponent';
    export default {
        components: {
            'projects-component':ProjectsComponent,
            'bubble-component':BubbleBGComponent,
        },
        methods: {
            getComponent() {
                return ProjectsComponent;
            }
        }
    }
</script>
