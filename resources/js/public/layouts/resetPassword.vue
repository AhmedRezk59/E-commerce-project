<template>
    <div>
        <div class="container-fluid">
            <div class="row no-gutter">
                <!-- The image half -->
                <div class="col-md-6 d-none d-md-flex bg-image"></div>

                <!-- The content half -->
                <div class="col-md-6 bg-light">
                    <div class="login d-flex align-items-center py-5">
                        <!-- Demo content-->
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-10 col-xl-7 mx-auto">
                                    <h3 class="display-4 mb-3">
                                        E-commerce Market
                                    </h3>

                                    <form @submit.prevent="updatePassword()">
                                        <div class="form-group mb-3">
                                            <input
                                                id="inputPassword"
                                                type="password"
                                                :placeholder="$t('password')"
                                                class="form-control rounded-pill border-0 shadow-sm px-4 text-primary"
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
                                        <div class="form-group mb-3">
                                            <input
                                                id="password-confirmation"
                                                type="password"
                                                :placeholder="
                                                    $t('Password Confirmation')
                                                "
                                                class="form-control rounded-pill border-0 shadow-sm px-4 text-primary"
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

                                        <button
                                            type="submit"
                                            class="btn btn-primary btn-block text-uppercase mb-2 rounded-pill shadow-sm"
                                        >
                                            {{ $t("Register") }}
                                        </button>
                                    </form>
                                    <div class="text-center">
                                        <router-link
                                            class="small text-decoration-underline"
                                            :to="{
                                                name: 'SignIn'
                                            }"
                                            >{{
                                                $t(
                                                    "there is an account? please sign in!"
                                                )
                                            }}</router-link
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End -->
                    </div>
                </div>
                <!-- End -->
            </div>
        </div>
    </div>
</template>

<script>
import Api from "../../api/users api";
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

    methods: {
        updatePassword() {
            Api()
                .put(`/resetpassword/${this.token}`, this.form)
                .then(res => {
                    if (res.status == 201) {
                        alert(res.data);
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

<style scoped>
.login,
.image {
    min-height: 100vh;
}

.bg-image {
    background-image: url("https://bootstrapious.com/i/snippets/sn-page-split/bg.jpg");
    background-size: cover;
    background-position: center center;
}
</style>
