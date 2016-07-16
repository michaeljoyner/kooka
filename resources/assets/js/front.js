let swal = require('sweetalert');
let Vue = require('vue');
Vue.use(require('vue-resource'));

if(document.querySelector('#x-token')) {
    Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#x-token').getAttribute('content');
}

Vue.component('cart-alert', require('./components/Cartalert.vue'));
Vue.component('cart-button', require('./components/Cartbutton.vue'));
Vue.component('cart-item', require('./components/Cartitem.vue'));
Vue.component('cart-app', require('./components/Cart.vue'));
window.Vue = Vue;
window.swal = swal;

new Vue({
    el: 'body',

    events: {

        'item-added': function() {
            this.$broadcast('update-cart');
        },

        'message': function(alert) {
            swal({
                type: alert.type,
                title: alert.title,
                text: alert.text,
                timer: alert.time || null,
                showConfirmButton: alert.confirm
            });
        }
    }
});