<template>
    <div>
        <cart-details></cart-details>
    </div>
</template>

<script>
import cartDetails from "../layouts/cartDetails.vue";

export default {
    components: {
        cartDetails,
    }
};
</script>

<style scoped>
body {
    background: #ddd;
}
</style>
