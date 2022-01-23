import Vue from 'vue';
import Vuex from 'vuex'
Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        product: '',
        products: { meta: { last_page: 1 } },
        relatedProducts: [],
        cart: [],
        orders: []
    },
    getters: {
        department: state => {
            if (state.product) return state.product.department
        },
    }
})
export default store;