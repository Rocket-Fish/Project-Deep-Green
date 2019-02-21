<template>
    <div class="bg">
        <projects-component></projects-component>
    </div>
</template>
<script>
    import ProjectsComponent from '../components/ProjectsComponent';
    export default {
        components: {
            'projects-component':ProjectsComponent,
        }
    }
</script>
<style lang="scss" scoped>
$blue: #51D4D4;

.bg {
    height: 100vh;
    position:relative;
	background: linear-gradient(to top right, $blue, #FFF);
}
</style>
