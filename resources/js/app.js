/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./frontend');
require('./pages/home');

window.Vue = require('vue');

Vue.filter('momentDate', function(value) {
  return moment(value).format('ddd, MMM D');
});

Vue.filter('momentTime', function(value) {
  return moment(value).format('h:mm a');
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
  el: '#app',
});

// ===============================================================================

$(function() {
  // @todo , lipat sa frontend.js
  if (document.querySelector('.phone')) {
    const phone = [{ mask: '+63 ###-###-####' }];
    $('.phone').inputmask({
      mask: phone,
      greedy: false,
      definitions: { '#': { validator: '[0-9]', cardinality: 1 } },
      removeMaskOnSubmit: false,
    });
  }
});
