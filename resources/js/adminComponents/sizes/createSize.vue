<template>
    <div>
        <div>
            <div id="wrapper">
                <div class="container mt-5">
                    <div class="alert alert-success" v-if="showSizeAddedMsg">
                        {{ sizeAddedMsg }}
                    </div>
                    <router-link
                        :to="{ name: 'Sizes' }"
                        class="btn btn-primary"
                        >{{ $t("Back btn") }}</router-link
                    >
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">
                                            {{ $t("Add Size") }}!
                                        </h1>
                                    </div>
                                    <form
                                        class="user"
                                        @submit.prevent="AddSize()"
                                    >
                                        <div class="form-group row ">
                                            <div class="col-sm-12 mb-3 mb-sm-0">
                                                <input
                                                    type="text"
                                                    class="form-control form-control-user"
                                                    id="name_ar"
                                                    name="name_ar"
                                                    :placeholder="
                                                        $t('Arabic Name')
                                                    "
                                                    v-model="form.name_ar"
                                                />
                                                <span
                                                    class="text-danger"
                                                    v-if="errors.name_ar"
                                                    >{{
                                                        $t(errors.name_ar[0])
                                                    }}</span
                                                >
                                            </div>
                                        </div>

                                        <div class="form-group row ">
                                            <div class="col-sm-12 mb-3 mb-sm-0">
                                                <input
                                                    type="text"
                                                    class="form-control form-control-user"
                                                    id="name_en"
                                                    name="name_en"
                                                    :placeholder="
                                                        $t('English Name')
                                                    "
                                                    v-model="form.name_en"
                                                />
                                                <span
                                                    class="text-danger"
                                                    v-if="errors.name_en"
                                                    >{{
                                                        $t(errors.name_en[0])
                                                    }}</span
                                                >
                                            </div>
                                        </div>

                                        <div class="form-group row ">
                                            <div class="col-sm-12 mb-3 mb-sm-0">
                                                <select
                                                    class="form-control form-control-lg"
                                                    id="department_id"
                                                    name="department_id"
                                                    placeholder="Department"
                                                    v-model="form.department_id"
                                                >
                                                    <option
                                                        value=""
                                                        disabled
                                                        selected
                                                        >{{
                                                            $t(
                                                                "Please Choose a department"
                                                            )
                                                        }}</option
                                                    >
                                                    <option
                                                        v-for="department in departments"
                                                        :key="department.id"
                                                        :value="department.id"
                                                        >{{
                                                            $i18n.locale == "ar"
                                                                ? department.text_ar
                                                                : department.text_en
                                                        }}</option
                                                    >
                                                </select>
                                                <span
                                                    class="text-danger"
                                                    v-if="errors.department_id"
                                                    >{{
                                                        $t(
                                                            errors
                                                                .department_id[0]
                                                        )
                                                    }}</span
                                                >
                                            </div>
                                        </div>
                                        <div class="form-group row ">
                                            <div class="col-sm-12 mb-3 mb-sm-0">
                                                <select
                                                    class="form-control form-control-lg"
                                                    id="department_id"
                                                    name="department_id"
                                                    placeholder="Public status"
                                                    v-model="form.is_public"
                                                >
                                                    <option
                                                        value=""
                                                        disabled
                                                        selected
                                                        >{{
                                                            $t(
                                                                "Please Choose public status"
                                                            )
                                                        }}</option
                                                    >
                                                    <option value="yes">{{
                                                        $t("yes")
                                                    }}</option>
                                                    <option value="no">{{
                                                        $t("no")
                                                    }}</option>
                                                </select>
                                                <span
                                                    class="text-danger"
                                                    v-if="errors.is_public"
                                                    >{{
                                                        $t(errors.is_public[0])
                                                    }}</span
                                                >
                                            </div>
                                        </div>

                                        <button
                                            type="submit"
                                            class="btn btn-primary btn-user btn-block"
                                        >
                                            {{ $t("Add Size") }}
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
    </div>
</template>

<script>
import Api from "../../api/api";

export default {
    data() {
        return {
            showSizeAddedMsg: false,
            sizeAddedMsg: "",
            form: {
                name_ar: "",
                name_en: "",
                department_id: "",
                is_public: ""
            },
            errors: []
        };
    },
    computed: {
        departments() {
            return this.$store.state.departments;
        }
    },
    methods: {
        AddSize() {
            Api()
                .post("/admin/sizes", this.form)
                .then(res => {
                    this.sizeAddedMsg = this.$t(res.data);
                    this.showSizeAddedMsg = true;
                    this.$store.commit("getSizes");
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
