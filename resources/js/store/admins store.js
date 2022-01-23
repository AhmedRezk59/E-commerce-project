import Vue from 'vue';
import Vuex from 'vuex'
import Api from '../api/api'
Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        admins: [],
        products: [],
        departments: [],
        users: [],
        trademarks: [],
        colors: [],
        sizes: [],
        weights: [],
        orders: [],
    },
    mutations: {
        getUsers: state => {
            Api()
                .get("/admin/users")
                .then(res => {
                    state.users = res.data;
                })
                .catch(error => console.error(error));
        },
        getAdmins: state => {
            Api()
                .get("/admin/admins")
                .then(res => {
                    state.admins = res.data;
                })
                .catch(error => console.error(error));
        },
       
        getDepartments: state => {
            Api()
                .get("/admin/departments")
                .then(res => {
                    state.departments = res.data;
                })
                .catch(error => console.error(error));
        },
        getTrademarks: state => {
            Api()
                .get("/admin/trademarks")
                .then(res => {
                    state.trademarks = res.data;
                })
                .catch(error => console.error(error));
        },
       
        getColors: state => {
            Api()
                .get("/admin/colors")
                .then(res => {
                    state.colors = res.data;
                })
                .catch(error => console.error(error));
        },
        getSizes: state => {
            Api()
                .get("/admin/sizes")
                .then(res => {
                    state.sizes = res.data;
                })
                .catch(error => console.error(error));
        },
        getWeights: state => {
            Api()
                .get("/admin/weights")
                .then(res => {
                    state.weights = res.data;
                })
                .catch(error => console.error(error));
        },
        getProducts: state => {
            Api()
                .get("/admin/products")
                .then(res => {
                    state.products = res.data;
                })
                .catch(error => console.error(error));
        },
        getOrders: state => {
            Api()
                .get("/admin/orders")
                .then(res => {
                    state.orders = res.data;
                })
                .catch(error => console.error(error));
        },
    }
})
export default store;