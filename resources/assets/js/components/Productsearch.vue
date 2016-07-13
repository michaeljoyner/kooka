<style></style>

<template>
    <div class="product-search-container">
        <section class="dd-page-header clearfix">
            <h1 class="pull-left">Products</h1>
            <div class="header-actions pull-right">
                <form class="input-and-go-form" v-on:submit.stop.prevent="">
                    <input type="text" placeholder="Search products by name" v-model="searchTerm">
                </form>
            </div>
        </section>
        <section class="products-index">
            <ul class="product-search-list">
                <li v-for="product in products | orderBy 'name' | filterBy searchTerm in 'name'">
                    <a href="/admin/products/@{{ product.id }}">
                        <div class="product-search-card">
                            <div class="product-search-card-image-box">
                                <img :src="product.thumb_src" alt="">
                            </div>
                            <div class="product-search-card-details">
                                <p class="title">{{ product.name }}</p>
                                <p class="description">{{ product.description }}</p>
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
        </section>
    </div>
</template>

<script type="text/babel">
    module.exports = {
        data() {
            return {
                products: [],
                searchTerm: ''
            }
        },

        ready() {
            this.fetchProducts();
        },

        methods: {
            fetchProducts() {
                this.$http.get('/admin/products')
                        .then((res) => this.$set('products', res.data))
                        .catch(() => console.log('unable to fetch products'));
            }
        }
    }
</script>