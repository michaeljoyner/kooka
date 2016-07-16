<style></style>

<template>
    <div class="cart-summary-alert-box" :class="{'exposed': expose}">
        <h3>Your cart</h3>
        <p>{{ product_count }} products /  {{ item_count }} items.</p>
        <p class="cart-subtotal">R{{ subtotal }}</p>
    </div>
</template>

<script type="text/babel">
    module.exports = {

        data() {
            return {
                item_count: 0,
                product_count: 0,
                subtotal: "0.00",
                expose: false
            }
        },

        ready() {
            this.fetchCartInfo(false);
        },

        events: {

            'update-cart': function() {
                this.fetchCartInfo(true);
            }
        },

        methods: {

            fetchCartInfo(shouldFlash) {
                this.$http.get('/cart/summary')
                        .then((res) => this.updateCartData(res.data, shouldFlash))
                        .catch(() => console.log('unable to get cart summary'));
            },

            updateCartData(data, shouldFlash) {
                this.item_count = data.item_count;
                this.product_count = data.product_count;
                this.subtotal = data.price;

                if(shouldFlash) {
                    this.flash();
                }
            },

            flash() {
                this.expose = true;
                setTimeout(() => this.expose = false, 2000);
            }
        }
    }
</script>