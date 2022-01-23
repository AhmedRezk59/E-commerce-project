<template>
    <div class="card-body">
        <div class="row mb-3 ml-1">
            <router-link :to="{ name: 'CreateSize' }" class="btn btn-primary" v-if="is_super == 1">{{
                $t("Add Size")
            }}</router-link>
        </div>
        <datatable
            :columns="columns"
            :rows="rows"
            :buttons="{ edit: { routeName: 'EditSize' }, delete: true }"
            name="Size"
            deleteRoute="sizes"
            mutation="getSizes"
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
                    label: "Arabic Name",sortable_label: "name_ar"
                },
                {
                    label: "English Name",sortable_label: "name_en"
                },
                {
                    label: "Department"
                },
                {
                    label: "Is public"
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
            return this.$store.state.sizes.map(size => {
                return {
                    id: size.id,
                    name_ar: size.name_ar,
                    name_en: size.name_en,
                    department: this.$store.state.departments.filter(
                        department => department.id == size.department_id
                    )[0],
                    is_public: size.is_public
                };
            });
        }
    }
};
</script>

<style></style>
