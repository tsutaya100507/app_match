
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'))
Vue.component('ProjectList', require('./components/templates/ProjectList'))
Vue.component('ProjectDetail', require('./components/templates/ProjectDetail'))
Vue.component('ProjectCreate', require('./components/templates/ProjectCreate'))
Vue.component('Profile', require('./components/templates/Profile'))
Vue.component('ProjectApplied', require('./components/templates/ProjectApplied'))
Vue.component('ProjectPosted', require('./components/templates/ProjectPosted'))
Vue.component('PublicMessages', require('./components/templates/PublicMessages'))
Vue.component('DirectMessages', require('./components/templates/DirectMessages'))
Vue.component('WelcomeView', require('./components/templates/WelcomeView'))
Vue.component('DmRoom', require('./components/templates/DmRoom'))


const app = new Vue({
    el: '#app'
});
