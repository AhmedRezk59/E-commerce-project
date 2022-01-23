<template>
    <div>
        <section class="py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6">
                        <img
                            class="card-img-top mb-5 mb-md-0 product-image"
                            width="250px"
                            height="250px"
                            :src="
                                `/upload/products/logos/${product.id}/${product.photo}`
                            "
                            alt="..."
                        />
                    </div>
                    <div class="col-md-6">
                        <div class="small mb-1" v-if="product.trademark">
                            {{ $t("Trademark") + " : " + product.trademark }}
                        </div>
                        <div class="small" v-if="product.department">
                            {{
                                $t("Department") +
                                    " : " +
                                    product.department["name_" + $i18n.locale]
                            }}
                        </div>
                        <h1 class="display-5 fw-bolder">{{ product.title }}</h1>
                        <p class="lead mb-3">
                            {{ product.content }}
                        </p>
                        <div class="fs-5 ">
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
                            <span
                                v-if="
                                    product.price_offer > 0 &&
                                        checkDates(
                                            product.start_offer_at,
                                            product.end_offer_at
                                        )
                                "
                            >
                                {{
                                    $t("product offer finish") +
                                        " " +
                                        getEndOfferTime(product.end_offer_at)
                                }}</span
                            >
                        </div>
                        <div class="text-danger" v-if="+product.stock < 20">
                            {{
                                $t("still stock") + product.stock + $t("units")
                            }}
                        </div>
                        <div class="small mb-3" v-if="product.color">
                            {{
                                $t("Color") +
                                    " : " +
                                    product.color["name_" + $i18n.locale]
                            }}
                        </div>
                        <div class="d-flex">
                            <input
                                class="form-control text-center mx-3 me-3"
                                id="inputQuantity"
                                type="number"
                                min="1"
                                value="1"
                                style="max-width: 3rem"
                                v-model="form.quantity"
                            />
                            <form @submit.prevent="addToCart()">
                                <button
                                    class="btn btn-outline-dark flex-shrink-0"
                                    type="submit"
                                >
                                    <i class="fas fa-shopping-cart"></i>
                                    {{ $t("Add to cart") }}
                                </button>
                            </form>
                        </div>
                        <span class="text-danger" v-if="errors.quantity">{{
                            $t(errors.quantity[0])
                        }}</span>
                    </div>
                </div>
                <div class="col mt-5">
                    <div class="col fw-bold lead">
                        {{ $t("Additional information") }}
                    </div>
                    <div class="col my-2">
                        {{ product.other_data }}
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
import Api from "../../api/users api";
import moment from "moment";

export default {
    data() {
        return {
            form: {
                product_id: "",
                quantity: 1
            },
            currentDate: new Date().getTime(),
            errors: []
        };
    },
    computed: {
        product() {
            return this.$store.state.product;
        }
    },

    watch: {
        product() {
            if (!this.product.id) {
                this.getProduct();
            }
        },
        $route(to, from) {
            if (this.product.encrypted_id != this.$route.params.id)
                this.getProduct();
        }
    },
    created() {
        this.getProduct();
    },
    methods: {
        getProduct() {
            Api()
                .get("/get/product/" + this.$route.params.id)
                .then(res => {
                    this.$store.state.product = res.data;
                })
                .catch(error => console.error(error));
        },

        addToCart() {
            if (localStorage.getItem("user_token") == null) {
                alert(this.$t("Please sign in first!"));
                this.$router.push({ name: "SignIn" });
            }
            this.form.product_id = this.product.id;
            Api()
                .post("/cart", this.form)
                .then(res => {
                    this.$store.state.cart = res.data;
                })
                .catch(error => (this.errors = error.response.data.errors));
        },
        checkDates(start_offer_at, end_offer_at) {
            return (
                new Date(start_offer_at).getTime() <= this.currentDate &&
                new Date(end_offer_at).getTime() >= this.currentDate
            );
        },
        getEndOfferTime(date) {
            return moment(date).fromNow();
        }
    }
};
</script>

<style scoped>
.product-image {
    width: 400px;
    height: 400px;
}
</style>
