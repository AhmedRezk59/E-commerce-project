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
                                                Forgot Your Password?
                                            </h1>
                                            <div
                                                class="alert alert-success"
                                                v-if="message"
                                            >
                                                <p>{{ message }}</p>
                                            </div>

                                            <p class="mb-4">
                                                We get it, stuff happens. Just
                                                enter your email address below
                                                and we'll send you a link to
                                                reset your password!
                                            </p>
                                        </div>
                                        <form
                                            @submit.prevent="sendmail()"
                                            class="user"
                                        >
                                            <div class="form-group">
                                                <span
                                                    class="text-danger"
                                                    v-if="errors.email"
                                                    >{{ errors.email[0] }}</span
                                                >
                                                <input
                                                    type="email"
                                                    class="form-control form-control-user"
                                                    id="email"
                                                    name="email"
                                                    aria-describedby="emailHelp"
                                                    v-model="form.email"
                                                    placeholder="Enter Email Address..."
                                                />
                                            </div>
                                            <button
                                                type="submit"
                                                class="btn btn-primary btn-user btn-block"
                                            >
                                                Reset Password
                                            </button>
                                        </form>
                                        <hr />
                                        <div class="text-center">
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
            form: {
                email: ""
            },
            message: "",
            errors: []
        };
    },
    methods: {
        sendmail() {
            Api()
                .post("/admin/sendmail", this.form)
                .then(res => {
                    this.message = res.data;
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                });
        }
    }
};
</script>

<style>
.cont {
    width: 100vw;
    height: 100vh;
}
</style>
