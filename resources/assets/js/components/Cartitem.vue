<style></style>

<template>
    <div class="cart-item">
        <div class="cart-item-thumb-box">
            <img :src="thumb" :alt="productName" width="50px" height="50px">
        </div>
        <span class="cart-item-name">{{ productName }}</span>
        <div class="cart-item-qty-box">
            <div v-show="!editing" class="edit-show">
                <span class="cart-item-quantity number">{{ quantity }}</span>
                <button class="cart-edit-btn cart-qty-btn" v-on:click="editing = ! editing">
                    Edit
                </button>
            </div>
            <div v-show="editing" class="edit-edit">
                <form v-on:submit.stop.prevent="editQuantity">
                    <input class="number" type="number" min="1" v-model="quantity">
                    <button class="cart-save-btn cart-qty-btn">
                        <span v-show="!saving">Save</span>
                        <div class="spinner" v-show="saving">
                            <div class="bounce1"></div>
                            <div class="bounce2"></div>
                            <div class="bounce3"></div>
                        </div>
                    </button>
                </form>
            </div>
        </div>
        <span class="cart-item-subtotal">R{{ subtotal }}</span>
        <div class="cart-item-trash">
            <button>delete</button>
        </div>
    </div>
</template>

<script type="text/babel">
    module.exports = {
        props: ['product-id', 'product-name', 'thumb', 'product-qty', 'subtotal'],

        data() {
            return {
                quantity: 1,
                editing: false,
                saving: false
            }
        },

        ready() {
            this.quantity = this.productQty;
        },

        methods: {
            editQuantity() {
                if(this.quantity < 1) {
                    return this.quantity = 1;
                }

                this.saving = true;
                this.$http.patch('/cart/update', {id: this.productId, quantity: this.quantity})
                        .then((res) => this.onSuccessfullUpdate(res.data))
                        .catch(() => this.onUpdateFailure());
            },

            onSuccessfullUpdate(responseData) {
                this.subtotal = responseData.subtotal;
                this.saving = false;
                this.editing = false;
            },

            onUpdateFailure() {
                this.saving = false;
                console.log('unable to edit quantity');
                this.$dispatch('message', {
                    type: 'error',
                    title: 'Oops. Sorry',
                    text: 'There was an error updating the quantity of your cart item. Please try again, or refresh the page. If you have further problems please contact us and we will help you directly. Thanks',
                    confirm: true
                });
            }
        }


    }
</script>