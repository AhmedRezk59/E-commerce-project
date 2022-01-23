<template>
    <div>
        <div id="wrapper">
            <div class="container mt-5">
                <div class="alert alert-success" v-if="showAdminAddedMsg">
                    {{ adminAddedMsg }}
                </div>
                <router-link
                    :to="{ name: 'MainUserAdmin' }"
                    class="btn btn-primary"
                    >{{ $t("Back btn") }}</router-link
                >
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">
                                        {{ $t("Create a User") }}!
                                    </h1>
                                </div>
                                <form class="user" @submit.prevent="addUser()">
                                    <div class="form-group row ">
                                        <div class="col-sm-12 mb-3 mb-sm-0">
                                            <input
                                                type="text"
                                                class="form-control form-control-lg"
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
                                            class="form-control form-control-lg"
                                            :placeholder="$t('Email Address')"
                                            v-model="form.email"
                                        />
                                        <span
                                            class="text-danger"
                                            v-if="errors.email"
                                            >{{ $t(errors.email[0]) }}</span
                                        >
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 mb-3 mb-sm-0">
                                            <input
                                                type="password"
                                                class="form-control form-control-lg"
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
                                                class="form-control form-control-lg"
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
                                        {{ $t("Register User") }}
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
                name: "",
                email: "",
                password: "",
                password_confirmation: ""
            },
            errors: [],
            showAdminAddedMsg: false,
            adminAddedMsg: ""
        };
    },

    methods: {
        addUser() {
            Api()
                .post("/admin/users", this.form)
                .then(res => {
                    this.adminAddedMsg = this.$t(res.data);
                    this.showAdminAddedMsg = true;
                    this.$store.commit("getUsers");
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
