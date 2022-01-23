<template>
    <div>
        <product-details></product-details>
        <related-items></related-items>
    </div>
</template>

<script>

import productDetails from "../layouts/productDetails.vue";
import relatedItems from "../layouts/relatedItems.vue";
export default {
    components: {
        productDetails,
        relatedItems,
    },
    
};
</script>

<style></style>
