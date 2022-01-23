<template>
    <div>
        <link
            rel="stylesheet"
            v-if="$i18n.locale == 'ar'"
            href="/css/bootstrap-rtl.min.css"
        />
        <link
            rel="stylesheet"
            v-if="$i18n.locale != 'ar'"
            href="/css/bootstrap-icons-users.css"
        />
        <nav-bar></nav-bar>
        <router-view></router-view>
        <page-footer></page-footer>
    </div>
</template>

<script>
import navBar from "../layouts/navbar.vue";
import pageFooter from "../layouts/footer.vue";

export default {
    components: {
        navBar,
        pageFooter
    }
};
</script>

<style></style>
