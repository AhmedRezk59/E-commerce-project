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

                                    <form @submit.prevent="login()">
                                        <div class="form-group mb-3">
                                            <input
                                                type="email"
                                                :placeholder="
                                                    $t('Email address')
                                                "
                                                autofocus
                                                class="form-control rounded-pill border-0 shadow-sm px-4"
                                                v-model="form.email"
                                            />
                                            <span
                                                class="text-danger"
                                                v-if="errors.email"
                                                >{{ $t(errors.email[0]) }}</span
                                            >
                                        </div>
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

                                        <button
                                            type="submit"
                                            class="btn btn-primary btn-block text-uppercase mb-2 rounded-pill shadow-sm"
                                        >
                                            {{ $t("Sign in") }}
                                        </button>
                                    </form>
                                    <div class="text-center">
                                        <router-link
                                            class="small text-decoration-underline"
                                            :to="{
                                                name: 'Register'
                                            }"
                                            >{{
                                                $t(
                                                    "No account? please register!"
                                                )
                                            }}</router-link
                                        >
                                    </div>
                                    <div class="text-center">
                                        <router-link
                                            class="small text-decoration-underline"
                                            :to="{
                                                name: 'ForgotPassword'
                                            }"
                                            >{{
                                                $t("forgot password!")
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
import EventBus from "../../event";

export default {
    data() {
        return {
            form: {
                email: "",
                password: ""
            },
            errors: []
        };
    },
    methods: {
        login() {
            Api()
                .post("/login", this.form)
                .then(res => {
                    localStorage.setItem("user_token", res.data.token);
                    localStorage.setItem(
                        "authnticated user",
                        JSON.stringify(res.data.data)
                    );
                    EventBus.$emit("updateName", res.data.data.name);
                    this.$router.push({ name: "Main" });
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
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
