/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./others');

window.Vue = require('vue');

Vue.filter('momentDate', function (value) {
  return moment(value).format('ddd, MMM D')
})

Vue.filter('momentTime', function (value) {
  return moment(value).format('h:mm a')
})

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// Vue.component('schedule', require('./components/Schedule.vue').default);
Vue.component('week-schedule', require('./components/WeekSchedule.vue').default);
Vue.component('dynamic-forms', require('./components/DynamicForms.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});


$(".confirmWarning").click(function(e) {
	let msg = $(this).data('confirm') || 'Are you sure?';
	let msgText = $(this).data('confirm-text') || '';
	let cancelText = $(this).data('cancel-text') || 'Cancel';
	e.preventDefault();
	let _self = $(this);

	Swal.fire({
	  title: msg,
	  text: msgText,
	  icon: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#828384',
	  cancelButtonText: cancelText,
	  confirmButtonText: 'Yes, continue!'
	}).then((result) => {
		if (result.value) {
			window.location = _self.attr("href")
		}
	})
})

$(".confirmDelete").click(function(e) {
	var msg = $(this).data('confirm') || 'Are you sure?';
	var msgText = $(this).data('confirm-text') || '';
	e.preventDefault();
	var _self = $(this);
	Swal.fire({
	  title: msg,
	  text: msgText,
	  icon: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#DD6B55',
	  cancelButtonColor: '#828384',
	  confirmButtonText: 'Yes, delete it!'
	}).then((result) => {
		if (result.value) {
			_self.closest("form").submit();
			_self.prop('disabled', true);
			setTimeout(function() {
				_self.prop('disabled', false);
			}, 2000);
		}
	})
});

// $(".confirmCancelSubmit").click(function(e) {
// 	var msg = $(this).data('confirm') || 'Are you sure?';
// 	var msgText = $(this).data('confirm-text') || '';
// 	e.preventDefault();
// 	var _self = $(this);
// 	swal({
// 		title: msg,
// 		text: msgText,
// 		type: "warning",
// 		showCancelButton: true,
// 		confirmButtonColor: "#DD6B55",
// 		confirmButtonText: "Yes, Continue!",
// 		closeOnConfirm: true
// 	}, function(isConfirm) {
// 		if (isConfirm) {
// 			_self.closest("form").submit();
// 			_self.prop('disabled', true);
// 			setTimeout(function() {
// 				_self.prop('disabled', false);
// 			}, 2000);
// 		}
// 	});
// });

$(".confirmSubmit").click(function(e) {
	var msg = $(this).data('confirm') || 'Are you sure?';
	var msgText = $(this).data('confirm-text') || '';
	e.preventDefault();
	var _self = $(this);

	Swal.fire({
	  title: msg,
	  text: msgText,
	  icon: 'info',
	  showCancelButton: true,
	  confirmButtonColor: '#449d44',
	  cancelButtonColor: '#828384',
	  confirmButtonText: 'Yes, Continue!'
	}).then((result) => {
		if (result.value) {
			_self.closest("form").submit();
			_self.prop('disabled', true);
			setTimeout(function() {
				_self.prop('disabled', false);
			}, 2000);
		}
	})
});
