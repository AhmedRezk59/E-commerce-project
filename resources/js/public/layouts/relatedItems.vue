<template>
    <div>
        <section class="py-5 bg-light">
            <div class="container px-4 px-lg-5 mt-5">
                <h2 class="fw-bolder mb-4">{{ $t("Related products") }}</h2>
                <div
                    class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center"
                >
                    <div
                        class="col mb-5"
                        v-for="product in relatedProducts"
                        :key="product.id"
                    >
                        <div class="card h-100">
                            <!-- Product image-->
                            <img
                                class="card-img-top product-image"
                                :src="
                                    `/upload/products/logos/${product.id}/${product.photo}`
                                "
                                width="250px"
                                height="250px"
                                alt="..."
                            />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">
                                        {{ product.title }}
                                    </h5>
                                    <!-- Product price-->
                                    <span
                                        :class="{
                                            'text-muted':
                                                product.price_offer > 0,
                                            'text-decoration-line-through':
                                                product.price_offer > 0
                                        }"
                                    >
                                        {{ product.price }}</span
                                    >
                                    <span v-if="product.price_offer > 0">
                                        {{ product.price_offer }}</span
                                    >
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div
                                class="card-footer p-4 pt-0 border-top-0 bg-transparent"
                            >
                                <div class="text-center">
                                    <router-link
                                        class="btn btn-outline-dark mt-auto"
                                        :to="{
                                            name: 'showProduct',
                                            params: { id: product.encrypted_id }
                                        }"
                                        >{{ $t("Show Product") }}</router-link
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
import Api from "../../api/users api";
export default {
    computed: {
        department() {
            return this.$store.getters.department;
        },
        relatedProducts() {
            return this.$store.state.relatedProducts;
        }
    },
    created() {
        this.getRelatedProducts();
    },
    watch: {
        department() {
            this.getRelatedProducts();
        }
    },
    methods: {
        getRelatedProducts() {
            if (!this.department) return false;
            Api()
                .get(`/related/products/${this.department.id}`)
                .then(res => {
                    this.$store.state.relatedProducts = res.data;
                })
                .catch(error => console.error(error));
        }
    }
};
</script>

<style scoped>
.product-image {
    width: 100%;
}
</style>
