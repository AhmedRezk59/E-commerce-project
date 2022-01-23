<template>
    <div class="bg-gradient-primary cont">
        <div class="container">
            <!-- Outer Row -->
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-12 col-md-9">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div
                                    class="col-lg-6 d-none d-lg-block bg-password-image"
                                ></div>
                                <div class="col-lg-6">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-2">
                                                Enter new Password
                                            </h1>
                                            <div
                                                class="alert alert-success"
                                                v-if="errMsg"
                                            >
                                                <p>{{ errMsg }}</p>
                                            </div>
                                            <div
                                                class="alert alert-success"
                                                v-if="successMsg"
                                            >
                                                <p>{{ successMsg }}</p>
                                                <div class="text-center">
                                                    <router-link
                                                        :to="{
                                                            name: 'AdminLogin'
                                                        }"
                                                        class="lead"
                                                        >Login!</router-link
                                                    >
                                                </div>
                                            </div>
                                            <p class="mb-4">
                                                We get it, stuff happens. Just
                                                enter your email address below
                                                and we'll send you a link to
                                                reset your password!
                                            </p>
                                        </div>
                                        <form
                                            @submit.prevent="updatePassword()"
                                            class="user"
                                        >
                                            <div class="form-group">
                                                <span
                                                    class="text-danger"
                                                    v-if="errors.password"
                                                    >{{
                                                        errors.password[0]
                                                    }}</span
                                                >
                                                <input
                                                    type="password"
                                                    class="form-control form-control-user"
                                                    id="password"
                                                    name="password"
                                                    aria-describedby="password"
                                                    v-model="form.password"
                                                    placeholder="Enter new password"
                                                />
                                            </div>
                                            <div class="form-group">
                                                <span
                                                    class="text-danger"
                                                    v-if="
                                                        errors.password_confirmation
                                                    "
                                                    >{{
                                                        errors
                                                            .password_confirmation[0]
                                                    }}</span
                                                >
                                                <input
                                                    type="password"
                                                    class="form-control form-control-user"
                                                    id="password_confirmation"
                                                    name="password_confirmation"
                                                    aria-describedby="password"
                                                    v-model="
                                                        form.password_confirmation
                                                    "
                                                    placeholder="Confirm password"
                                                />
                                            </div>
                                            <button
                                                type="submit"
                                                class="btn btn-primary btn-user btn-block"
                                            >
                                                Reset Password
                                            </button>
                                        </form>
                                        <div class="text-center pt-2">
                                            <router-link
                                                :to="{ name: 'AdminRegister' }"
                                                class="small"
                                                >Create an Account!</router-link
                                            >
                                        </div>
                                        <div class="text-center">
                                            <router-link
                                                :to="{ name: 'AdminLogin' }"
                                                class="small"
                                                >Already have an account?
                                                Login!</router-link
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Api from "../../../api/api.js";
export default {
    data() {
        return {
            token: this.$route.params.token,
            form: {
                password: "",
                password_confirmation: ""
            },
            errMsg: "",
            errors: [],
            successMsg: ""
        };
    },
    created() {
        this.checkToken();
    },
    methods: {
        checkToken() {
            Api()
                .post(`/admin/checkToken/${this.token}`)
                .catch(error => {
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors;
                    } else if (error.response.status == 403) {
                        this.errMsg = error.response.data;
                    }
                });
        },
        updatePassword() {
            Api()
                .put(`/admin/resetpassword/${this.token}`, this.form)
                .then(res => {
                    if (res.status == 201) {
                        this.successMsg = res.data;
                    }
                })
                .catch(error => {
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors;
                    } else if (error.response.status == 403) {
                        this.errMsg = error.response.data.message;
                    }
                });
        }
    }
};
</script>

<style></style>
