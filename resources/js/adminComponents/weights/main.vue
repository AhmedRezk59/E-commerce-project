<template>
    <div class="card-body">
        <div class="row mb-3 ml-1">
            <router-link
                :to="{ name: 'CreateWeight' }"
                class="btn btn-primary"
                v-if="is_super == 1"
                >{{ $t("Add Weight") }}</router-link
            >
        </div>
        <datatable
            :columns="columns"
            :rows="rows"
            :buttons="{ edit: { routeName: 'EditWeight' }, delete: true }"
            name="Weight"
            deleteRoute="weights"
            mutation="getWeights"
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
                    label: "Arabic Name",
                    sortable_label: "name_ar"
                },
                {
                    label: "English Name",
                    sortable_label: "name_en"
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
            return this.$store.state.weights;
        }
    }
};
</script>

<style></style>
