
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./pinBoot');
require('./analytics');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('privacy-modal', require('./components/Privacy-Modal.vue').default);
Vue.component('trix', require('./components/Trix.vue').default);
Vue.component('contact-form', require('./components/ContactForm.vue').default);

const app = new Vue({
    el: '#app'
});