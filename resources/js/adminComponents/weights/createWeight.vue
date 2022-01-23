<template>
    <div>
        <div>
            <div id="wrapper">
                <div class="container mt-5">
                    <div class="alert alert-success" v-if="showWeightAddedMsg">
                        {{ weightAddedMsg }}
                    </div>
                    <router-link
                        :to="{ name: 'Weights' }"
                        class="btn btn-primary"
                        >{{ $t("Back btn") }}</router-link
                    >
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">
                                            {{ $t("Add Weight") }}!
                                        </h1>
                                    </div>
                                    <form
                                        class="user"
                                        @submit.prevent="AddWeight()"
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

                                        <button
                                            type="submit"
                                            class="btn btn-primary btn-user btn-block"
                                        >
                                            {{ $t("Add Weight") }}
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
            showWeightAddedMsg: false,
            weightAddedMsg: "",
            form: {
                name_ar: "",
                name_en: ""
            },
            errors: []
        };
    },

    methods: {
        AddWeight() {
            Api()
                .post("/admin/weights", this.form)
                .then(res => {
                    this.weightAddedMsg = this.$t(res.data);
                    this.showWeightAddedMsg = true;
                    this.$store.commit("getWeights");
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
