<template>
    <div class="card">
        <div class="row">
            <div class="col-md-8 cart">
                <div class="title">
                    <div class="row">
                        <div
                            class="alert alert-success"
                            v-if="showSuccessfulPayment"
                        >
                            {{ $t("successful payment") }}
                        </div>
                        <div class="col">
                            <h4>
                                <b>{{ $t("Shopping Cart") }}</b>
                            </h4>
                        </div>
                        <div
                            class="col align-self-center text-right text-muted"
                        >
                            {{ `${cart.length} ${$t("items")}` }}
                        </div>
                    </div>
                </div>
                <div
                    v-if="cart.length == 0"
                    class="row border-top border-bottom"
                >
                    {{ $t("No products in cart") }}
                </div>
                <div
                    class="row border-top border-bottom"
                    v-for="product in cart"
                    :key="product.id"
                >
                    <div class="row main align-items-center">
                        <div class="col-2">
                            <img
                                class="img-fluid"
                                :src="
                                    `/upload/products/logos/${product.id}/${product.photo}`
                                "
                            />
                        </div>
                        <div class="col text-center">
                            <div class="row text-muted">
                                {{ product.department["name_" + $i18n.locale] }}
                            </div>
                            <router-link
                                :to="{
                                    name: 'showProduct',
                                    params: { id: product.encrypted_id }
                                }"
                                class="row"
                                >{{ product.title }}</router-link
                            >
                        </div>
                        <div class="col">
                            {{ `${$t("Quantity")} : ${product.quantity}` }}
                        </div>
                        <div class="col">
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
                        <div class="col">
                            <i
                                class="fa fa-times fa-2x dalete"
                                :data-product_id="product.encrypted_id"
                                @click="deleteProduct"
                            ></i>
                        </div>
                    </div>
                </div>

                <div class="back-to-shop">
                    <router-link
                        :to="{ name: 'Main' }"
                        class="text-decoration-none"
                        >&leftarrow;<span class="text-muted">{{
                            $t("Back to shop")
                        }}</span></router-link
                    >
                </div>
            </div>
            <div class="col-md-4 summary" v-if="cart.length > 0">
                <div>
                    <h5>
                        <b>{{ $t("Summary") }}</b>
                    </h5>
                </div>

                <hr />
                <div class="row fw-bold" style=" padding: 2vh 0;">
                    <div class="col">{{ $t("TOTAL PRICE") }}</div>
                    <div class="col text-right">{{ totalPrice }}</div>
                </div>
                <hr />
                <div class="row fw-bold">
                    <form @submit.prevent="pay()">
                        <div class="col d-block">
                            {{ $t("Payment methods") }}
                        </div>
                        <div class="col d-flex">
                            <label for="paypal">{{ $t("Paypal") }}</label>
                            <input
                                type="radio"
                                name="payment_method"
                                id="CREDIT"
                                value="CREDIT"
                                v-model="form.payment_method"
                            />
                            <label for="cash">{{ $t("Cash") }}</label>
                            <input
                                type="radio"
                                name="payment_method"
                                id="CASH"
                                value="CASH"
                                v-model="form.payment_method"
                            />
                        </div>
                        <button
                            :class="{
                                btn: true,
                                'fw-bold': true,
                                disabled: !form.payment_method
                            }"
                        >
                            {{ $t("Place Order") }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Api from "../../api/users api";
export default {
    data() {
        return {
            currentDate: new Date().getTime(),
            totalPrice: "",
            form: { payment_method: "" },
            showSuccessfulPayment: false
        };
    },
    computed: {
        cart() {
            return this.$store.state.cart;
        }
    },
    created() {
        this.getTotalPrice();
    },

    watch: {
        cart() {
            this.getTotalPrice();
        }
    },
    methods: {
        checkDates(start_offer_at, end_offer_at) {
            return (
                new Date(start_offer_at).getTime() <= this.currentDate &&
                new Date(end_offer_at).getTime() >= this.currentDate
            );
        },
        getTotalPrice() {
            if (this.cart.length == 0) return;
            let filteredPrices = this.cart.map(product => {
                if (
                    this.checkDates(
                        product.start_offer_at,
                        product.end_offer_at
                    )
                ) {
                    return product.price_offer * +product.quantity;
                } else {
                    return product.price * +product.quantity;
                }
            });
            this.totalPrice = filteredPrices.reduce((a, b) => +a + +b);
        },
        deleteProduct(e) {
            Api()
                .delete("/cart/" + e.target.dataset.product_id)
                .then(res => {
                    this.$store.state.cart = res.data;
                })
                .catch(error => console.error(error));
        },
        pay() {
            Api()
                .post("/pay", this.form)
                .then(res => {
                    if (this.form.payment_method != "CASH") {
                        window.location.href = res.data.Data.InvoiceURL;
                    } else {
                        this.$store.state.cart = [];
                        this.showSuccessfulPayment = true;
                    }
                })
                .catch(error => console.error(error));
        }
    }
};
</script>

<style scoped>
body {
    background: #ddd;
    min-height: 100vh;
    vertical-align: middle;
    display: flex;
    font-family: sans-serif;
    font-size: 0.8rem;
    font-weight: bold;
}

.title {
    margin-bottom: 5vh;
}

.card {
    margin: auto;
    max-width: 1280px;
    width: 90%;
    box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    border-radius: 1rem;
    border: transparent;
}

@media (max-width: 767px) {
    .card {
        margin: 3vh auto;
    }
}

.cart {
    background-color: #fff;
    padding: 4vh 5vh;
    border-bottom-left-radius: 1rem;
    border-top-left-radius: 1rem;
}

@media (max-width: 767px) {
    .cart {
        padding: 4vh;
        border-bottom-left-radius: unset;
        border-top-right-radius: 1rem;
    }
}

.summary {
    background-color: #ddd;
    border-top-right-radius: 1rem;
    border-bottom-right-radius: 1rem;
    padding: 4vh;
    color: rgb(65, 65, 65);
}

@media (max-width: 767px) {
    .summary {
        border-top-right-radius: unset;
        border-bottom-left-radius: 1rem;
    }
}

.summary .col-2 {
    padding: 0;
}

.summary .col-10 {
    padding: 0;
}

.row {
    margin: 0;
}

.title b {
    font-size: 1.5rem;
}

.main {
    margin: 0;
    padding: 2vh 0;
    width: 100%;
}

.col-2,
.col {
    padding: 0 1vh;
}

a {
    padding: 0 1vh;
}

.close {
    margin-left: auto;
    font-size: 0.7rem;
}

img {
    width: 3.5rem;
}

.back-to-shop {
    margin-top: 4.5rem;
}

h5 {
    margin-top: 4vh;
}

hr {
    margin-top: 1.25rem;
}

form {
    padding: 2vh 0;
}

select {
    border: 1px solid rgba(0, 0, 0, 0.137);
    padding: 1.5vh 1vh;
    margin-bottom: 4vh;
    outline: none;
    width: 100%;
    background-color: rgb(247, 247, 247);
}

input {
    border: 1px solid rgba(0, 0, 0, 0.137);
    padding: 1vh;
    margin-bottom: 4vh;
    outline: none;
    width: 100%;
    background-color: rgb(247, 247, 247);
}

input:focus::-webkit-input-placeholder {
    color: transparent;
}

.btn {
    background-color: #000;
    border-color: #000;
    color: white;
    width: 100%;
    font-size: 0.7rem;
    margin-top: 4vh;
    padding: 1vh;
    border-radius: 0;
}

.btn:focus {
    box-shadow: none;
    outline: none;
    box-shadow: none;
    color: white;
    -webkit-box-shadow: none;
    transition: none;
}

.btn:hover {
    color: white;
}

a {
    color: black;
}

a:hover {
    color: black;
    text-decoration: none;
}
.dalete {
    cursor: pointer;
}
</style>
