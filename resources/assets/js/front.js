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
Vue.component('contact-form', require('./components/Contactform.vue'));
Vue.component('product-gallery', require('./components/Productgallery.vue'));
Vue.component('carousel', require('./components/Slider.vue'));

Vue.http.interceptors.unshift(function(request, next) {
    next(function(response) {
        if(typeof response.headers['content-type'] != 'undefined') {
            response.headers['Content-Type'] = response.headers['content-type'];
        }
    });
});

window.Vue = Vue;
window.swal = swal;

new Vue({
    el: 'body',

    events: {

        'item-added': function() {
            this.$broadcast('update-cart');
        },

        'item-updated': function() {
            this.$broadcast('update-cart');
        },

        'item-removed': function() {
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

if(document.querySelector('.top-sellers')) {
    $(document).ready(function(){
        var prev = $('#previous');
        $('.product-slider').slick({
            dots: true,
            infinite: true,
            speed: 700,
            autoplay: true,
            autoplaySpeed: 5000,
            slidesToShow: 3,
            slidesToScroll: 3,
            respondTo: 'min',
            prevArrow: '<svg class="slick-prev" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 47.45 63.04"><defs></defs><title>left arrow</title><path d="M2.44,35.75h0L42,62.45a3.52,3.52,0,0,0,4.86-.93,3.63,3.63,0,0,0-.82-4.8L18,33.7a3.28,3.28,0,0,1,0-5.07L45.32,6.16a3.52,3.52,0,0,0,.5-4.92A3.63,3.63,0,0,0,41,.65L2.44,26.58a5.61,5.61,0,0,0-1.5,1.5A5.53,5.53,0,0,0,2.44,35.75Z"/></svg>',
            nextArrow: '<svg class="slick-next" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 47.45 63.04"><title>right arrow</title><path d="M45,27.29h0L5.43.59a3.52,3.52,0,0,0-4.86.93,3.63,3.63,0,0,0,.82,4.8l28.1,23a3.28,3.28,0,0,1,0,5.07L2.13,56.88a3.52,3.52,0,0,0-.5,4.92,3.63,3.63,0,0,0,4.83.59L45,36.46a5.61,5.61,0,0,0,1.5-1.5A5.53,5.53,0,0,0,45,27.29Z"/></svg>',
            responsive: [
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 750,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                    }
                }
            ]
        });
    });

}
