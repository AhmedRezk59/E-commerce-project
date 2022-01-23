<template>
    <div class="card-body">
        <div class="row mb-3 ml-1">
            <router-link :to="{ name: 'CreateAdmin' }" class="btn btn-primary" v-if="is_super == 1"
                >{{$t("Add Admin")}}</router-link
            >
        </div>
        <datatable
            :columns="columns"
            :rows="rows"
            :buttons="{ edit: { routeName: 'EditColor' }, delete: true }"
            name="Admin"
            deleteRoute="admins"
            mutation="getAdmins"
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
            is_super:'',
            columns: [
                { label: "Id" },
                {
                    label: "Name",sortable_label: "name"
                },

                { label: "super"},
                { label: "Email" ,sortable_label: "email"},
                {
                    label: "Created at"
                },
                {
                    label: "Updated at"
                },
                {
                    label: "Check All"
                }
            ],
        };
    },
     mounted() {
        this.is_super = JSON.parse(
            localStorage.getItem("authnticated admin")
        ).is_super;
    },
     computed: {
        rows() {
            return this.$store.state.admins.map(admin => {return{
                'id':admin.id,
                'name':admin.name,
                'super':admin.is_super == 1 ? 'yes' : 'no',
                'email':admin.email,
                'created_at':admin.created_at,
                'updated_at':admin.updated_at,
            }});
        }
    },
    
};
</script>

<style scoped></style>
