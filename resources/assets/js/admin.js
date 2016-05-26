window.swal = require('sweetalert');

var Vue = require('vue');

Vue.use(require('vue-resource'));

if(document.querySelector('#x-token')) {
    Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#x-token').getAttribute('content');
}

Vue.component('toggle-button', require('./components/Togglebutton.vue'));

window.Vue = Vue;