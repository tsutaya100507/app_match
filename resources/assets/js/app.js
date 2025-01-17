
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VeeValidate, {Validator} from 'vee-validate';
import ja from 'vee-validate/dist/locale/ja';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'))
Vue.component('ProjectList', require('./components/templates/ProjectList'))
Vue.component('ProjectDetail', require('./components/templates/ProjectDetail'))
Vue.component('ProjectCreate', require('./components/templates/ProjectCreate'))
Vue.component('ProjectEdit', require('./components/templates/ProjectEdit'))
Vue.component('Profile', require('./components/templates/Profile'))
Vue.component('ProjectApplied', require('./components/templates/ProjectApplied'))
Vue.component('ProjectPosted', require('./components/templates/ProjectPosted'))
Vue.component('PublicMessages', require('./components/templates/PublicMessages'))
Vue.component('DirectMessages', require('./components/templates/DirectMessages'))
Vue.component('WelcomeView', require('./components/templates/WelcomeView'))
Vue.component('DmRoom', require('./components/templates/DmRoom'))
Vue.component('ProfileEdit', require('./components/templates/ProfileEdit'))


Vue.use(VeeValidate, {
    events: '',
    locale: 'ja',
    dictionary: {
      ja: {
        custom: {
          title: {
            required: '必須の項目です'
          },
          lower_price: {
            min_value: '1以上の数値を入力してください'
          },
          description: {
            required: '必須の項目です'
          }
        },
      },
    }})
  Validator.localize('ja', ja);

const app = new Vue({
    el: '#app'
});
