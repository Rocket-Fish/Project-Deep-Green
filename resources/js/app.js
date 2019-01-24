
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import vueHeadful from 'vue-headful';
import VueRouter from 'vue-router'
//window.VueRouter = require('vue-router');

Vue.component('vue-headful', vueHeadful);
Vue.use(VueRouter);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

//const files = require.context('./', true, /\.vue$/i)
//files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// adds example component (which doesn't exist anymore)
//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/*
* The following section setups and creates the vue routes
* which im using to create the different pages on the site
* It is currently hardcoded
*
*/
import Home from './views/Home'
import About from './views/About'
import Projects from './views/Projects'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/about',
            name: 'about',
            component: About,
        },
        {
            path: '/projects',
            name: 'projects',
            component: Projects,
        },
    ],
});

/*
*
*
*/
import App from './views/App'

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});
