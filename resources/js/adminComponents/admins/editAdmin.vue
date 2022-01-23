<template>
    <div>
        <div id="wrapper">
            <div class="container mt-5">
                <div class="alert alert-success" v-if="showAdminEditedMsg">
                    {{ adminEditedMsg }}
                </div>
                <router-link :to="{ name: 'Main' }" class="btn btn-primary"
                    >Back</router-link
                >
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">
                                        {{ $t("Edit Admin") }}!
                                    </h1>
                                </div>
                                <form
                                    class="user"
                                    @submit.prevent="editAdmin()"
                                >
                                    <div class="form-group row ">
                                        <div class="col-sm-12 mb-3 mb-sm-0">
                                            <input
                                                type="text"
                                                class="form-control form-control-user"
                                                id="name"
                                                name="name"
                                                :placeholder="$t('Name')"
                                                v-model="form.name"
                                            />
                                            <span
                                                class="text-danger"
                                                v-if="errors.name"
                                                >{{ $t(errors.name[0]) }}</span
                                            >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input
                                            type="email"
                                            name="email"
                                            id="email"
                                            class="form-control form-control-user"
                                            :placeholder="$t('Email Address')"
                                            v-model="form.email"
                                        />
                                        <span
                                            class="text-danger"
                                            v-if="errors.email"
                                            >{{ $t(errors.email[0]) }}</span
                                        >
                                    </div>
                                    <div class="form-group">
                                        <select
                                            type="is_super"
                                            name="is_super"
                                            id="is_super"
                                            class="form-control form-control-lg"
                                            v-model="form.is_super"
                                        >
                                            <option
                                                value=""
                                                disabled
                                                selected
                                                >{{ $t("super admin") }}</option
                                            >
                                            <option :value="true">{{
                                                $t("yes")
                                            }}</option>
                                            <option :value="false">{{
                                                $t("no")
                                            }}</option>
                                        </select>
                                        <span
                                            class="text-danger"
                                            v-if="errors.is_super"
                                            >{{ $t(errors.is_super[0]) }}</span
                                        >
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 mb-3 mb-sm-0">
                                            <input
                                                type="password"
                                                class="form-control form-control-user"
                                                id="password"
                                                name="password"
                                                :placeholder="$t('Password')"
                                                v-model="form.password"
                                            />
                                            <span
                                                class="text-danger"
                                                v-if="errors.password"
                                                >{{
                                                    $t(errors.password[0])
                                                }}</span
                                            >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <input
                                                type="password"
                                                class="form-control form-control-user"
                                                id="password_confirmation"
                                                name="password_confirmation"
                                                :placeholder="
                                                    $t('Confirm Password')
                                                "
                                                v-model="
                                                    form.password_confirmation
                                                "
                                            />
                                            <span
                                                class="text-danger"
                                                v-if="
                                                    errors.password_confirmation
                                                "
                                                >{{
                                                    $t(
                                                        errors
                                                            .password_confirmation[0]
                                                    )
                                                }}</span
                                            >
                                        </div>
                                    </div>
                                    <button
                                        type="submit"
                                        class="btn btn-primary btn-user btn-block"
                                    >
                                        {{ $t("Update Account") }}
                                    </button>
                                    <hr />
                                </form>
                                <hr />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Api from "../../api/api";
export default {
    data() {
        return {
            form: {
                id: this.$route.params.id,
                name: "",
                email: "",
                is_super: "",
                password: "",
                password_confirmation: ""
            },
            errors: [],
            showAdminEditedMsg: false,
            adminEditedMsg: ""
        };
    },
    computed: {
        admin() {
            return this.$store.state.admins.filter(
                admin => admin.id == this.$route.params.id
            )[0];
        }
    },
    watch: {
        admin() {
            this.getAdmin();
        }
    },
    created() {
        this.getAdmin();
    },
    methods: {
        getAdmin() {
            if (!this.admin) return false;
            this.form.name = this.admin.name;
            this.form.email = this.admin.email;
            this.form.is_super = this.admin.is_super = 1 ? true : false;
        },
        editAdmin() {
            Api()
                .put(`/admin/admins/${this.$route.params.id}`, this.form)
                .then(res => {
                    this.adminEditedMsg = this.$t(res.data);
                    this.showAdminEditedMsg = true;
                    this.$store.commit("getAdmins");
                })
                .catch(error => {
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors;
                    }
                });
        }
    }
};
</script>

<style></style>
