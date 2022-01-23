<template>
    <div>
        <div>
            <div id="wrapper">
                <div class="container mt-5">
                    <!-- nav pills -->
                    <router-link
                        :to="{ name: 'Products' }"
                        class="btn btn-primary mb-4"
                        >{{ $t("Back btn") }}</router-link
                    >
                    <ul
                        class="nav nav-pills mb-3"
                        id="pills-tab"
                        role="tablist"
                    >
                        <li class="nav-item">
                            <a
                                class="nav-link active"
                                id="pills-home-tab"
                                data-toggle="pill"
                                href="#product-info"
                                role="tab"
                                aria-controls="pills-home"
                                aria-selected="true"
                                >{{ $t("Product info") }}</a
                            >
                        </li>
                        <li class="nav-item">
                            <a
                                class="nav-link"
                                id="pills-home-tab"
                                data-toggle="pill"
                                href="#product-department"
                                role="tab"
                                aria-controls="pills-home"
                                aria-selected="true"
                                >{{ $t("Product department") }}</a
                            >
                        </li>
                        <li class="nav-item">
                            <a
                                class="nav-link"
                                id="pills-profile-tab"
                                data-toggle="pill"
                                href="#product-settings"
                                role="tab"
                                aria-controls="pills-profile"
                                aria-selected="false"
                                >{{ $t("Product settings") }}</a
                            >
                        </li>

                        <li class="nav-item">
                            <a
                                class="nav-link"
                                id="pills-contact-tab"
                                data-toggle="pill"
                                href="#product-media"
                                role="tab"
                                aria-controls="pills-contact"
                                aria-selected="false"
                                >{{ $t("Product media") }}</a
                            >
                        </li>
                        <li class="nav-item">
                            <a
                                class="nav-link"
                                id="pills-contact-tab"
                                data-toggle="pill"
                                href="#product-size-weight"
                                role="tab"
                                aria-controls="pills-contact"
                                aria-selected="false"
                                >{{ $t("Product shipping") }}</a
                            >
                        </li>
                        <li class="nav-item">
                            <a
                                class="nav-link"
                                id="pills-contact-tab"
                                data-toggle="pill"
                                href="#product-other_data"
                                role="tab"
                                aria-controls="pills-contact"
                                aria-selected="false"
                                >{{ $t("Product other data") }}</a
                            >
                        </li>
                    </ul>

                    <!-- end nav pills -->
                    <div
                        class="alert alert-success"
                        v-if="showProductEditedMsg"
                    >
                        {{ productEditedMsg }}
                    </div>
                    <div
                        class="alert alert-danger font-weight-bold"
                        v-if="showErrorMsg"
                    >
                        {{ $t("error message") }}
                    </div>

                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-md-12">
                                <form
                                    enctype="multipart/form-data"
                                    @submit.prevent="UpdateProduct()"
                                >
                                    <div class="p-2">
                                        <div
                                            class="tab-content"
                                            id="pills-tabContent"
                                        >
                                            <!-- product info -->
                                            <div
                                                class="tab-pane fade show active"
                                                id="product-info"
                                                role="tabpanel"
                                                aria-labelledby="pills-home-tab"
                                            >
                                                <product-info
                                                    @changeForm="changeForm"
                                                    :errors="errors"
                                                    :form="form"
                                                ></product-info>
                                            </div>
                                            <!-- end product info -->
                                            <!-- product department -->
                                            <div
                                                class="tab-pane fade"
                                                id="product-department"
                                                role="tabpanel"
                                                aria-labelledby="pills-profile-tab"
                                            >
                                                <product-department
                                                    @changeForm="changeForm"
                                                    :errors="errors"
                                                    :form="form"
                                                ></product-department>
                                            </div>
                                            <!-- end product department -->
                                            <!-- product settings -->
                                            <div
                                                class="tab-pane fade"
                                                id="product-settings"
                                                role="tabpanel"
                                                aria-labelledby="pills-profile-tab"
                                            >
                                                <product-settings
                                                    @changeForm="changeForm"
                                                    :errors="errors"
                                                    :form="form"
                                                ></product-settings>
                                            </div>
                                            <!-- end product settings -->
                                            <!-- product media -->
                                            <div
                                                class="tab-pane fade"
                                                id="product-media"
                                                role="tabpanel"
                                                aria-labelledby="pills-contact-tab"
                                            >
                                                <edit-media
                                                    :files="files"
                                                ></edit-media>
                                            </div>
                                            <!-- end product media -->
                                            <!-- product shipping -->
                                            <div
                                                class="tab-pane fade"
                                                id="product-size-weight"
                                                role="tabpanel"
                                                aria-labelledby="pills-contact-tab"
                                            >
                                                <product-shipping
                                                    @cahngeForm="changeForm"
                                                    :errors="errors"
                                                    :form="form"
                                                ></product-shipping>
                                                <!-- end malls -->
                                            </div>
                                            <!-- end product shipping -->
                                            <!-- other data -->
                                            <div
                                                class="tab-pane fade"
                                                id="product-other_data"
                                                role="tabpanel"
                                                aria-labelledby="pills-contact-tab"
                                            >
                                                <other-data
                                                    @changeForm="changeForm"
                                                    :errors="errors"
                                                    :form="form"
                                                ></other-data>
                                            </div>
                                            <!-- end other data -->
                                        </div>
                                    </div>

                                    <div class="d-block mt-4">
                                        <button
                                            type="submit"
                                            class="btn btn-primary"
                                        >
                                            {{ $t("save") }}
                                        </button>

                                        <span
                                            class="btn btn-danger"
                                            @click="emptyFields()"
                                            >{{ $t("Empty Fields") }}</span
                                        >
                                    </div>
                                </form>
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
import moment from "moment";

import otherData from "./components/otherData.vue";
import productShipping from "./components/productShipping.vue";
import editMedia from "./components/editMedia.vue";
import productSettings from "./components/productSettings.vue";
import productDepartment from "./components/productDepartment.vue";
import productInfo from "./components/productInfo.vue";

export default {
    components: {
        otherData,
        productShipping,
        editMedia,
        productSettings,
        productDepartment,
        productInfo
    },

    data() {
        return {
            showProductEditedMsg: false,
            showErrorMsg: false,
            productEditedMsg: "",
            form: {
                department_id: "",
                title: "",
                content: "",
                price: "",
                stock: "",
                start_at: new Date(),
                end_at: "",
                price_offer: "",
                start_offer_at: "",
                end_offer_at: "",
                photo: "",
                size_id: "",
                size: "",
                weight_id: "",
                weight: "",
                color_id: "",
                trademark_id: "",
                other_data: ""
            },
            files: [],
            errors: []
        };
    },

    computed: {
        product() {
            return this.$store.state.products.filter(
                product => product.id == this.$route.params.id
            )[0];
        }
    },
    watch: {
        product() {
            this.getProduct();
        }
    },
    created() {
        this.getProduct();
    },
    methods: {
        changeForm(data) {
            this.form[data.label] = data.value;
        },
        getProduct() {
            if (!this.product) return false;
            this.form.title = this.product.title;
            this.form.content = this.product.content;
            this.form.department_id = this.product.department_id ?? "";
            this.form.trademark_id = this.product.trademark_id ?? "";
            this.form.color_id = this.product.color_id ?? "";
            this.form.price = this.product.price;
            this.form.start_at = this.product.start_at;
            this.form.stock = this.product.stock;
            this.form.size = this.product.size;
            this.form.size_id = this.product.size_id ?? "";
            this.form.weight_id = this.product.weight_id ?? "";
            this.form.weight = this.product.weight;
            this.form.other_data = this.product.other_data;
            this.form.stock = this.product.stock;
            this.form.price_offer = this.product.price_offer;
            this.form.start_offer_at = this.product.start_offer_at;
            this.form.end_offer_at = this.product.end_offer_at;
            this.files = this.product.files;
        },

        UpdateProduct() {
            this.form.start_at = this.form.start_at
                ? moment(String(this.form.start_at)).format("YYYY-MM-DD")
                : "";

            this.form.start_offer_at = this.form.start_offer_at
                ? moment(String(this.form.start_offer_at)).format("YYYY-MM-DD")
                : "";
            this.form.end_offer_at = this.form.end_offer_at
                ? moment(String(this.form.end_offer_at)).format("YYYY-MM-DD")
                : "";

            Api()
                .put("/admin/products/" + this.$route.params.id, this.form)
                .then(res => {
                    this.productEditedMsg = this.$t(res.data);
                    this.showProductEditedMsg = true;
                    this.showErrorMsg = false;
                    this.errors = [];
                    this.$store.commit("getProducts");
                })
                .catch(error => {
                    if (error.response.status == 422) {
                        this.showProductEditedMsg = false;
                        this.showErrorMsg = true;
                        this.errors = error.response.data.errors;
                    }
                });
        },
        emptyFields() {
            this.form = {
                department_id: "",
                title: "",
                content: "",
                price: "",
                stock: "",
                start_at: "",
                end_at: "",
                price_offer: "",
                start_offer_at: "",
                end_offer_at: "",
                photo: "",
                size_id: "",
                size: "",
                weight_id: "",
                weight: "",
                color_id: "",
                trademark_id: "",
                other_data: ""
            };
        }
    }
};
</script>

<style></style>
