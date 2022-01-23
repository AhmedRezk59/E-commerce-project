<template>
    <div class="card-body">
        <div class="row mb-3 ml-1">
            <router-link :to="{ name: 'CreateUser' }" class="btn btn-primary" v-if="is_super == 1">{{
                $t("Create a User")
            }}</router-link>
        </div>
        <datatable
            :columns="columns"
            :rows="rows"
            :buttons="{ edit: { routeName: 'EditUser' }, delete: true }"
            name="User"
            deleteRoute="users"
            mutation="getUsers"
        ></datatable>
    </div>
</template>

<script>
import datatable from "../datatable/datatable";
export default {
    components: { datatable },
    data() {
        return {
            page: 1,
            is_super: "",
            columns: [
                { label: "Id" },
                {
                    label: "Name",
                    sortable_label: "name"
                },
                { label: "Email", sortable_label: "email" },

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
            return this.$store.state.users.map(user => {
                return {
                    id: user.id,
                    name: user.name,
                    email: user.email,
                    created_at: user.created_at,
                    updated_at: user.updated_at
                };
            });
        }
    }
};
</script>

<style scoped></style>
