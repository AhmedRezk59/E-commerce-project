<template>
    <div class="card-body">
        <div class="row mb-3 ml-1">
            <router-link
                :to="{ name: 'CreateProduct' }"
                class="btn btn-primary"
                v-if="is_super == 1"
                >{{ $t("Add Product") }}</router-link
            >
        </div>
        <datatable
            :columns="columns"
            :rows="rows"
            :buttons="{ edit: { routeName: 'EditProduct' }, delete: true }"
            name="Product"
            deleteRoute="products"
            mutation="getProducts"
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
            is_super:'',
            columns: [
                { label: "Id" },
                {
                    label: "title",sortable_label: "title"
                },
                {
                    label: "Department"
                },
                {
                    label: "Color"
                },
                
                {
                    label: "price"
                },
                {
                    label: "price offer"
                },
                
                {
                    label: "photo"
                },

                {
                    label: "Check All"
                }
            ]
        };
    },
 mounted() {
        this.is_super = JSON.parse(
            localStorage.getItem("authnticated admin")
        ).is_super;
    },
    computed: {
        rows() {
            return this.$store.state.products.map(product => {
                return {
                    id: product.id,
                    title: product.title,
                    department: this.$store.state.departments.filter(
                        department => department.id == product.department_id
                    )[0] ?? '',
                    color: this.$store.state.colors.filter(
                        color => color.id == product.color_id
                    )[0] ?? '',
                    price: product.price,
                    price_offer: product.price_offer,
                    photo: product.photo
                };
            });
        }
    }
};
</script>

<style></style>
