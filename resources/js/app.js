
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
const VueResource = require('vue-resource');
const vueHeadful = require('vue-headful').default;
const VueRouter = require('vue-router').default;
const BootstrapVue = require( 'bootstrap-vue');
//window.VueRouter = require('vue-router');

Vue.component('vue-headful', vueHeadful);
Vue.use(VueRouter);
Vue.use(BootstrapVue);
Vue.use(VueResource);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */
// don't use these becuase they are only good for very very basic global components
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
import Projects from './views/Projects'
import Curds from './views/Curds'
import NotFound from './views/NotFound'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/projects',
            name: 'projects',
            component: Projects,
        },
        {
            path: '/curds',
            name: 'curds',
            component: Curds,
        },
        {
            path:'/404',
            name: '404',
            component: NotFound,
        },
        {
            path:'*',
            redirect: '/404',
        },
    ],
});

/*
*
*
*/
import App from './views/App'
// import navbar component
import NavbarComponent from './components/NavbarComponent'
// make this globally available
Vue.component('navbar-component', NavbarComponent)
import BGComponent from './components/BGComponent';
Vue.component('bg-component', BGComponent)


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    components: {
       App,
       NavbarComponent,
       BGComponent},
    router,
});
