<template>
    <div class="card-body">
        <div class="row mb-3 ml-1">
            <router-link
                :to="{ name: 'CreateColor' }"
                class="btn btn-primary"
                v-if="is_super == 1"
                >{{ $t("Add Color") }}</router-link
            >
        </div>
        <datatable
            :columns="columns"
            :rows="rows"
            :buttons="{ edit: { routeName: 'EditColor' }, delete: true }"
            name="Color"
            deleteRoute="colors"
            mutation="getColors"
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
                    label: "Arabic Name"
                },
                {
                    label: "English Name"
                },
                {
                    label: "Color"
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
            return this.$store.state.colors;
        }
    }
};
</script>

<style></style>
