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
        <a class="checkout-button" href="/checkout" v-show="items.length">Proceed to Checkout</a>
        <p class="sub-heading centered-text" v-else>You don't have any products in your cart.</p>
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

        events: {
            'delete-cart-item': function(item) {
                this.removeItem(item);
            }
        },

        methods: {

            fetchCartList: function() {
                this.$http.get('/cart/index')
                        .then(function(res) {
                            this.$set('items', res.data);
                        }).catch(function() { console.log('unable to fetch cart list')});
            },

            removeItem(item) {
                let product = this.items.filter(product => product.id === item.id).pop();
                this.$http.delete('/cart/remove', {body: item})
                        .then(() => this.onItemDeletion(product))
                        .catch(() => console.log('unable to remove item'));
            },

            onItemDeletion(item) {
                this.items.$remove(item);
                this.$dispatch('item-removed');
            }
        }
    }
</script>