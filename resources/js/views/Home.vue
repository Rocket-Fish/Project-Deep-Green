<template>
    <div>
        <bg-component :child_component="getComponent()"></bg-component>
    </div>
</template>
<script>
    import HomeComponent from '../components/HomeComponent';
    export default {
        components: {
            'home-component':HomeComponent,
        },
        methods: {
            getComponent() {
                return HomeComponent;
            }
        }
    }
</script>
