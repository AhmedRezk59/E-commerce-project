<template>
    <div>
        <router-link :to="{ name: 'Orders' }" class="btn btn-primary mb-3">{{
            $t("Back btn")
        }}</router-link>
        <div
            class="alert alert-success font-weight-bold"
            v-show="showOrderEditedMsg"
        >
            {{ $t("order updated successfully") }}
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">{{ $t("User") }}</th>
                    <th scope="col">{{ $t("Payment method") }}</th>
                    <th scope="col">{{ $t("Total Price") }}</th>
                    <th scope="col">{{ $t("Paid") }}</th>
                    <th scope="col">{{ $t("status") }}</th>
                    <th scope="col">{{ $t("Created at") }}</th>
                    <th scope="col">{{ $t("Updated at") }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ order.user.email }}</td>
                    <td>{{ order.payment_method }}</td>
                    <td>{{ order.total_price }}</td>
                    <td>{{ order.paid }}</td>
                    <td>{{ order.status }}</td>
                    <td>{{ order.created_at }}</td>
                    <td>{{ order.updated_at }}</td>
                </tr>
            </tbody>
        </table>
        <show-order-products :rows="order.products"></show-order-products>
        <form @submit.prevent="updateOrderStatus()">
            <select
                v-model="status"
                class="form-control form-control-user col-md-4 my-4"
            >
                <option value="PENDING">{{ $t("PENDING") }}</option>
                <option value="ONTHEROAD">{{ $t("ONTHEROAD") }}</option>
                <option value="DELIVERED">{{ $t("DELIVERED") }}</option>
            </select>
            <button type="submit" class="btn btn-primary">
                {{ $t("Update status") }}
            </button>
        </form>
    </div>
</template>

<script>
import showOrderProducts from "./showOrderPoducts.vue";
import Api from "../../api/api";
export default {
    components: {
        showOrderProducts
    },
    data() {
        return {
            status: "PENDING",
            showOrderEditedMsg: false
        };
    },
    watch: {
        order() {
            this.status = this.order.status;
        }
    },

    computed: {
        order() {
            if (this.$store.state.orders.length == 0)
                return {
                    user: { email: null },
                    status: null,
                    payment_method: null,
                    total_price: null,
                    paid: null,
                    products: [],
                    created_at: null,
                    updated_at: null
                };
            return this.$store.state.orders.filter(
                order => order.id == this.$route.params.id
            )[0];
        }
    },
    methods: {
        updateOrderStatus() {
            Api()
                .put("/admin/orders/" + this.order.id , {status : this.status})
                .then(() => {
                    this.showOrderEditedMsg = true;
                    this.$store.commit('getProducts')
                    this.$store.commit('getOrders')
                })
                .catch(error => console.error(error));
        }
    }
};
</script>

<style></style>
