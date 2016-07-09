window.swal = require('sweetalert');

var Vue = require('vue');

Vue.use(require('vue-resource'));

if(document.querySelector('#x-token')) {
    Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#x-token').getAttribute('content');
}

Vue.component('toggle-button', require('./components/Togglebutton.vue'));
Vue.component('single-upload', require('./components/Singleupload.vue'));
Vue.component('toggle-switch', require('./components/Toggleswitch.vue'));
Vue.component('dropzone', require('./components/Dropzone.vue'));
Vue.component('gallery-show', require('./components/Galleryshow.vue'));

window.Vue = Vue;