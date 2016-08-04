<style></style>

<template>
    <div class="product-gallery">
        <img class="main-image" :src="displaySrc" alt="{{ altText }}">
        <div class="thumbnail" v-for="thumb in thumbs" v-on:click="setSource(thumb)">
            <img :src="thumb.thumb_src" alt="{{ altText }}">
        </div>
    </div>
</template>

<script type="text/babel">
    module.exports = {

        props: ['initial', 'alt-text', 'product-id'],

        data() {
            return {
                thumbs: [],
                mainSrc: null
            }
        },

        computed: {
            displaySrc() {
                return this.mainSrc || this.initial;
            }
        },

        ready() {
            this.fetchThumbs();
        },

        methods: {

            fetchThumbs() {
                this.$http.get('/api/products/' + this.productId + '/images')
                        .then(res => this.$set('thumbs', res.data))
                        .catch(() => console.log('unable to fetch images'));
            },

            setSource(image) {
                this.mainSrc = image.web_src;
            }

        }
    }
</script>