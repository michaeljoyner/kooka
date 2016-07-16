<style></style>

<template>
    <form action="" v-on:submit.stop.prevent="addToCart" class="add-to-cart-form">
        <input type="number" min="1" name="quantity" v-model="quantity" class="quantity-input">
        <button class="kooka-cart-btn" type="submit" :class="{'busy': adding}" :disabled="adding">
            <span v-show="!adding">Add to cart</span>
            <div class="spinner" v-show="adding">
                <div class="bounce1"></div>
                <div class="bounce2"></div>
                <div class="bounce3"></div>
            </div>
        </button>
    </form>
</template>

<script>
    module.exports = {
        props: ['product-id'],

        data: function() {
            return {
                quantity: 1,
                adding: false
            }
        },

        methods: {
            addToCart: function() {
                if(this.quantity < 1) {
                    return this.quantity = 1;
                }
                this.adding = true;
                this.$http.post('/cart/add', {
                    id: this.productId,
                    quantity: this.quantity
                }).then(function(res) {
                    this.adding = false;
                    this.$dispatch('item-added');
                    this.quantity = 1;
                }).catch(function(res) {
                    console.log('failed to add to cart');
                })
            }
        }
    }
</script>