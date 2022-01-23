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
                    <div class="alert alert-success" v-if="showProductAddedMsg">
                        {{ productAddedMsg }}
                    </div>
                    <div
                        class="alert alert-danger font-weight-bold"
                        v-if="showErrorMsg"
                    >
                        {{ $t("error message") }}
                    </div>
                    <router-link
                        :to="{ name: 'Products' }"
                        class="btn btn-primary mb-2"
                        >{{ $t("Back btn") }}</router-link
                    >
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-md-12">
                                <form
                                    enctype="multipart/form-data"
                                    @submit.prevent="AddProduct()"
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
                                                <product-media
                                                    @changeForm="changeForm"
                                                    @changeDropzone="
                                                        changeDropZone
                                                    "
                                                    :errors="errors"
                                                    :form="form"
                                                ></product-media>
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
import productMedia from "./components/productMedia.vue";
import productSettings from "./components/productSettings.vue";
import productDepartment from "./components/productDepartment.vue";
import productInfo from "./components/productInfo.vue";

export default {
    components: {
        otherData,
        productShipping,
        productMedia,
        productSettings,
        productDepartment,
        productInfo
    },

    data() {
        return {
            showProductAddedMsg: false,
            showErrorMsg: false,
            productAddedMsg: "",
            form: {
                department_id: "",
                title: "",
                photo: "",
                content: "",
                price: "",
                stock: "",
                start_at: new Date(),
                price_offer: "",
                start_offer_at: "",
                end_offer_at: "",
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

    methods: {
        changeForm(data) {
            this.form[data.label] = data.value;
        },
        changeDropZone(data) {
            this[data.label] = data.value;
        },
        AddProduct() {
            let formData = new FormData();

            //Using this config in my request, the response gives me the mentioned waring of missing boundary
            const config = {
                headers: {
                    "Content-Type": "multipart/form-data"
                }
            };

            formData.append("title", this.form.title);
            formData.append("photo", this.form.photo);
            formData.append("content", this.form.content);
            formData.append("department_id", this.form.department_id);
            formData.append("trademark_id", this.form.trademark_id);
            formData.append("color_id", this.form.color_id);
            formData.append("size", this.form.size);
            formData.append("size_id", this.form.size_id);
            formData.append("weight", this.form.weight);
            formData.append("weight_id", this.form.weight_id);
            formData.append("price", this.form.price);
            formData.append(
                "start_at",
                this.form.start_at
                    ? moment(String(this.form.start_at)).format("YYYY-MM-DD")
                    : ""
            );
           
            formData.append("price_offer", this.form.price_offer);
            formData.append(
                "start_offer_at",
                this.form.start_offer_at
                    ? moment(String(this.form.start_offer_at)).format(
                          "YYYY-MM-DD"
                      )
                    : ""
            );
            formData.append(
                "end_offer_at",
                this.form.end_offer_at
                    ? moment(String(this.form.end_offer_at)).format(
                          "YYYY-MM-DD"
                      )
                    : ""
            );

            formData.append("stock", this.form.stock);
            formData.append("other_data", this.form.other_data);
            Api()
                .post("/admin/products", formData, config)
                .then(res => {
                    this.productAddedMsg = this.$t(res.data);
                    this.showProductAddedMsg = true;
                    this.showErrorMsg = false;
                    this.errors = [];
                    this.uploadMultible();
                })
                .catch(error => {
                    if (error.response.status == 422) {
                        this.showProductAddedMsg = false;
                        this.showErrorMsg = true;
                        this.errors = error.response.data.errors;
                    }
                });
        },

        uploadMultible() {
            this.files.forEach(file => {
                let formData = new FormData();

                //Using this config in my request, the response gives me the mentioned waring of missing boundary
                const config = {
                    headers: {
                        "Content-Type": "multipart/form-data"
                    }
                };
                formData.append("file", file);
                Api()
                    .post("/admin/products/files", formData, config)
                    .catch(error => {
                        if (error.response.status == 422) {
                            this.errors = error.response.data.errors;
                        }
                    });
            });
            this.$store.commit("getProducts");
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
