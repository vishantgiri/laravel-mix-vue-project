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

Vue.component('navbar', require('./components/Navbar.vue'));
Vue.component('users-details', require('./components/UsersDetails.vue'));
Vue.component('file-upload',require('./components/FileUpload.vue'));
import Vue from 'vue';

 
Vue.mixin({
  data: function() {
    return {
      get appUrl() {
        return "/public/"; // AppURL 
      },
	  get appStorage() {
        return '/storage/app/'; // StorageUrl
      }
    }
  }
})

const app = new Vue({
  el: '#app'
});