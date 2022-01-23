<template>
    <div id="page-top">
        <div id="wrapper">
            <sidebar></sidebar>
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    <navbar></navbar>
                    <div class="container-fluid">
                        <dashboard-header></dashboard-header>
                        <router-view></router-view>
                    </div>
                </div>
                <page-footer></page-footer>
            </div>
        </div>
    </div>
</template>

<script>
import sidebar from "../layouts/sidebar.vue";
import navbar from "../layouts/navbar.vue";
import pageFooter from "../layouts/page-footer.vue";
import dashboardHeader from "../layouts/dashboardheader.vue";
import Api from "../../api/api";
export default {
    components: {
        sidebar,
        navbar,
        pageFooter,
        dashboardHeader
    },
    created() {
        this.loadResources();
    },
    methods: {
        loadResources() {
            this.getAdmins();
            this.getDepartments();
            this.getUsers();
            this.getColors();
            this.getSizes();
            this.getWeights();
            this.getTrademarks();
            this.getProducts();
            this.getOrders();
        },

        getAdmins() {
            if (this.$store.state.admins.length == 0) {
                Api()
                    .get("/admin/admins")
                    .then(res => {
                        this.$store.state.admins = res.data;
                    })
                    .catch(error => console.error(error));
            }
        },
        getProducts() {
            if (this.$store.state.products.length == 0) {
                Api()
                    .get("/admin/products")
                    .then(res => {
                        this.$store.state.products = res.data;
                    })
                    .catch(error => console.error(error));
            }
        },
        getDepartments() {
            if (this.$store.state.departments.length == 0) {
                Api()
                    .get("/admin/departments")
                    .then(res => {
                        this.$store.state.departments = res.data;
                    })
                    .catch(error => console.error(error));
            }
        },
        getUsers() {
            if (this.$store.state.users.length == 0) {
                Api()
                    .get("/admin/users")
                    .then(res => {
                        this.$store.state.users = res.data;
                    })
                    .catch(error => console.error(error));
            }
        },

        getTrademarks() {
            if (this.$store.state.trademarks.length == 0) {
                Api()
                    .get("/admin/trademarks")
                    .then(res => {
                        this.$store.state.trademarks = res.data;
                    })
                    .catch(error => console.error(error));
            }
        },
        getColors() {
            if (this.$store.state.colors.length == 0) {
                Api()
                    .get("/admin/colors")
                    .then(res => {
                        this.$store.state.colors = res.data;
                    })
                    .catch(error => console.error(error));
            }
        },
        getSizes() {
            if (this.$store.state.sizes.length == 0) {
                Api()
                    .get("/admin/sizes")
                    .then(res => {
                        this.$store.state.sizes = res.data;
                    })
                    .catch(error => console.error(error));
            }
        },
        getWeights() {
            if (this.$store.state.weights.length == 0) {
                Api()
                    .get("/admin/weights")
                    .then(res => {
                        this.$store.state.weights = res.data;
                    })
                    .catch(error => console.error(error));
            }
        },
        getOrders(){
              if (this.$store.state.orders.length == 0) {
                Api()
                    .get("/admin/orders")
                    .then(res => {
                        this.$store.state.orders = res.data;
                    })
                    .catch(error => console.error(error));
            }
        }
    }
};
</script>

<style></style>
