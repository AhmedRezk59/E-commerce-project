<template>
    <div class="card-body">
        <div class="row mb-3 ml-1">
            <router-link
                :to="{ name: 'CreateTrademark' }"
                class="btn btn-primary"
                v-if="is_super == 1"
                >{{ $t("Add Trademark") }}</router-link
            >
        </div>
        <datatable
            :columns="columns"
            :rows="rows"
            :buttons="{ edit: { routeName: 'EditTrademark' }, delete: true }"
            name="Trademark"
            deleteRoute="trademarks"
            mutation="getTrademarks"
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
                    label: "Name",sortable_label: "name"
                },

                {
                    label: "logo"
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
     mounted() {
        this.is_super = JSON.parse(
            localStorage.getItem("authnticated admin")
        ).is_super;
    },
    computed: {
        rows() {
            return this.$store.state.trademarks;
        }
    }
};
</script>

<style></style>
