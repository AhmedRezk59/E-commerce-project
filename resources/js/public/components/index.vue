<template>
    <div>
        <!-- <banner></banner> -->
        <div class="fluid-container d-flex">
            <filter-bar></filter-bar>
            <products></products>
        </div>
    </div>
</template>

<script>
import banner from "../layouts/banner.vue";
import filterBar from "../layouts/filterBar.vue";
import products from "../layouts/products.vue";
export default {
    components: {
        filterBar,
        banner,
        products
    }
};
</script>

<style></style>
