<template>
    <div>
        <section>
            <div class="container px-4 px-lg-5 mt-5">
                <div
                    class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center"
                >
                    <div
                        class="col mb-5"
                        v-for="product in products"
                        :key="product.id"
                    >
                        <div class="card h-100">
                            <!-- Product image-->
                            <img
                                class="card-img-top"
                                width="200"
                                height="200"
                                :src="
                                    `/upload/products/logos/${product.id}/${product.photo}`
                                "
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
                                                product.price_offer > 0 &&
                                                checkDates(
                                                    product.start_offer_at,
                                                    product.end_offer_at
                                                ),
                                            'text-decoration-line-through':
                                                product.price_offer > 0 &&
                                                checkDates(
                                                    product.start_offer_at,
                                                    product.end_offer_at
                                                )
                                        }"
                                    >
                                        {{ product.price }}</span
                                    >
                                    <span
                                        v-if="
                                            product.price_offer > 0 &&
                                                checkDates(
                                                    product.start_offer_at,
                                                    product.end_offer_at
                                                )
                                        "
                                    >
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
            <!-- pagination -->
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li :class="{ 'page-item': true, disabled: page == 1 }">
                        <a class="page-link" href="#" @click="previousPage()">{{
                            $t("Previous")
                        }}</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">{{ page }}</a>
                    </li>
                    <li
                        :class="{
                            'page-item': true,
                            disabled: page == lastPage
                        }"
                    >
                        <a class="page-link" href="#" @click="nextPage()">{{
                            $t("Next")
                        }}</a>
                    </li>
                </ul>
            </nav>
        </section>
    </div>
</template>

<script>
import Api from "../../api/users api";
import EventBus from "../../event";
export default {
    data() {
        return {
            page: 1,
            chosenDepartments: [],
            chosenTrademarks: [],
            currentDate: new Date().getTime()
        };
    },
    created() {
        this.getProducts();
    },
    mounted() {
        EventBus.$on("paginate", this.setParameters);
    },
    computed: {
        products() {
            return this.$store.state.products.data;
        },

        lastPage() {
            return this.$store.state.products.meta.last_page;
        }
    },
    methods: {
        getProducts() {
            Api()
                .get("/get/products", {
                    params: {
                        page: this.page,
                        chosenDepartments: this.chosenDepartments,
                        chosenTrademarks: this.chosenTrademarks
                    }
                })
                .then(res => {
                    this.$store.state.products = res.data;
                })
                .catch(error => console.error(error));
        },
        setParameters(data) {
            this.chosenDepartments = data.chosenDepartments;
            this.chosenTrademarks = data.chosenTrademarks;
        },
        previousPage() {
            this.page--;
            this.getProducts();
        },
        nextPage() {
            this.page++;
            this.getProducts();
        },
        checkDates(start_offer_at, end_offer_at) {
            return (
                new Date(start_offer_at).getTime() <= this.currentDate &&
                new Date(end_offer_at).getTime() >= this.currentDate
            );
        }
    }
};
</script>

<style></style>
