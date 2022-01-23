<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <router-link class="navbar-brand" :to="{ name: 'Main' }"
                    >E-commerce Market</router-link
                >
                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div
                    class="collapse navbar-collapse"
                    id="navbarSupportedContent"
                >
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item">
                            <router-link
                                class="nav-link active"
                                aria-current="page"
                                :to="{ name: 'Main' }"
                                >Home</router-link
                            >
                        </li>
                    </ul>
                    <div>
                        <router-link :to="{ name: 'SignIn' }" v-if="!name">{{
                            $t("Sign in")
                        }}</router-link>
                        <div class="dropdown" v-if="name">
                            <button
                                class="btn btn-secondary dropdown-toggle"
                                type="button"
                                id="dropdownMenu2"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                            >
                                {{ name }}
                            </button>
                            <div
                                class="dropdown-menu"
                                aria-labelledby="dropdownMenu2"
                            >
                                <router-link
                                    :to="{ name: 'Profile' }"
                                    class="dropdown-item"
                                >
                                    {{ $t("Profile") }}
                                </router-link>
                             
                                <form @submit.prevent="logout()">
                                    <button class="dropdown-item" type="submit">
                                        {{ $t("logout") }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- langs -->
                    <div class="mx-2">
                        <select
                            v-model="$i18n.locale"
                            class="form-control align-self-center"
                            @change="setLang()"
                        >
                            <option
                                v-for="(lang, i) in langs"
                                :key="i"
                                :value="lang.locale"
                            >
                                {{ $t(lang.label) }}
                            </option>
                        </select>
                    </div>
                    <div class="d-flex">
                        <router-link
                            class="btn btn-outline-dark"
                            :to="{ name: 'Cart' }"
                        >
                            <i class="fas fa-shopping-cart"></i>
                            {{ $t("Cart") }}
                            <span
                                class="badge bg-dark text-white ms-1 rounded-pill"
                                >{{ cartLength }}</span
                            >
                        </router-link>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
import Api from "../../api/users api";
import EventBus from "../../event";

export default {
    data() {
        return {
            langs: [
                { label: "Arabic_lang", locale: "ar" },
                { label: "English_lang", locale: "en" }
            ],
            form: {},
            name: JSON.parse(localStorage.getItem("authnticated user")).name
        };
    },
    computed: {
        cartLength() {
            return this.$store.state.cart.length;
        }
    },
    created() {
        this.getCartProducts();
    },
    mounted() {
        EventBus.$on("updateName", this.updateName);
    },

    methods: {
        setLang() {
            localStorage.setItem("users_lang", this.$i18n.locale);
        },
        updateName(data) {
            this.name = data;
            this.getCartProducts();
        },
        logout() {
            Api()
                .post("/logout", this.form)
                .then(() => {
                    localStorage.removeItem("user_token");
                    localStorage.removeItem("authnticated user");
                    this.name = null;
                    this.$store.state.cart = [];
                    this.$router.push({ name: "Main" });
                })
                .catch(err => console.error(err));
        },
        getCartProducts() {
            if (this.name == null) return;
            Api()
                .get("/cart")
                .then(res => {
                    this.$store.state.cart = res.data;
                })
                .catch(error => console.error(error));
        }
    }
};
</script>
