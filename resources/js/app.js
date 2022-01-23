
require('./bootstrap');

window.Vue = require('vue').default;
import Vue from 'vue';

import VueRouter from 'vue-router'

import router from './routes';

Vue.use(VueRouter);


import excel from 'vue-excel-export'



Vue.use(excel)


import VueI18n from 'vue-i18n';

Vue.use(VueI18n);

import ar_lang from "./lang/admins/ar"
import en_lang from "./lang/admins/en"

const messages = {
    ar: ar_lang,
    en: en_lang,
}
const i18n = new VueI18n({
    locale: localStorage.getItem('admins_lang') ?? 'en',
    messages
});

import store from './store/admins store'

const app = new Vue({
    el: '#app',
    router: router,
    i18n,
    store: store,
});

