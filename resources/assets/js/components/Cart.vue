<style></style>

<template>
    <div class="cart-list">
        <cart-item v-for="item in items"
                   :product-id="item.id"
                   :product-name="item.name"
                   :thumb="item.thumb"
                   :subtotal="item.subtotal"
                   :product-qty="item.quantity"
        ></cart-item>
    </div>
</template>

<script type="text/babel">
    module.exports = {

        data: function() {
            return {
                items: []
            }
        },

        ready: function() {
            this.fetchCartList();
        },

        methods: {

            fetchCartList: function() {
                this.$http.get('/cart/index')
                        .then(function(res) {
                            this.$set('items', res.data);
                        }).catch(function() { console.log('unable to fetch cart list')});
            }
        }
    }
</script>