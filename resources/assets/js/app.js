
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

Vue.config.devtools = true;
Vue.component('artist-create', require('./components/artist/create.vue'));

const app = new Vue({
  el:'#app'
});