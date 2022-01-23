<template>
    <div class="card-body">
        <datatable
            :columns="columns"
            :rows="rows"
            :buttons="{ edit: { routeName: 'ShowOrder' }, delete: false }"
            name="Order"
            deleteRoute="orders"
            mutation="getOrders"
        ></datatable>
    </div>
</template>

<script>
import datatable from "../datatable/datatable.vue";
export default {
    components: { datatable },
    data() {
        return {
            page: 1,
            is_super: "",
            columns: [
                { label: "Id" },
                {
                    label: "User"
                },
                {
                    label: "Payment method"
                },
                {
                    label: "Total Price"
                },
                {
                    label: "Paid"
                },
                {
                    label: "Created at"
                },
                {
                    label: "Updated at"
                },
                {
                    label: "Check All"
                }
            ]
        };
    },

    computed: {
        rows() {
            return this.$store.state.orders.map(order => {
                return {
                    'id' : order.id,
                    'user' : order.user.email,
                    'payment_method' : order.payment_method,
                    'total_price' : order.total_price,
                    'paid' : order.paid,
                    'created_at' : order.created_at,
                    'updated_at' : order.updated_at,
                }
            });
        }
    }
};
</script>

<style></style>
