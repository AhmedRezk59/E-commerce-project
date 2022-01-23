
require('./bootstrap');

window.Vue = require('vue').default;
import Vue from 'vue';

import VueRouter from 'vue-router'

import router from './user routes';

Vue.use(VueRouter);

import VueI18n from 'vue-i18n';

Vue.use(VueI18n);
import ar_lang from "./lang/users/ar"
import en_lang from "./lang/users/en"
const messages = {
    ar: ar_lang,
    en: en_lang,
}
const i18n = new VueI18n({
    locale: localStorage.getItem('users_lang') ?? 'en',
    messages
});

import Main from './public/components/main'
import store from './store/users store'



Vue.component('mainComponent', Main)
const app2 = new Vue({
    el: '#app2',
    router: router,
    i18n,
    store: store,

});
