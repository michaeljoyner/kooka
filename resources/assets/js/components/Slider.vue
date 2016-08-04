<style></style>

<template>
    <div class="dd-slider">
        <div class="slides-container">
            <slot name="one"></slot>
        </div>
    </div>
</template>

<script type="text/babel">
    module.exports = {
        ready() {
            alert('lets go');
        }
    }
</script>