<template>
    <div>
        <div>
            <div id="wrapper">
                <div class="container mt-5">
                    <div class="alert alert-success" v-if="showWeightEditedMsg">
                        {{ weightEditedMsg }}
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
                                            {{ $t("Edit Weight") }}!
                                        </h1>
                                    </div>
                                    <form
                                        class="user"
                                        @submit.prevent="editWeightData()"
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
                                            {{ $t("Update Weight") }}
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
            showWeightEditedMsg: false,
            weightEditedMsg: "",

            form: {
                id: this.$route.params.id,
                name_ar: "",
                name_en: ""
            },
            errors: []
        };
    },
    computed: {
        weight() {
            return this.$store.state.weights.filter(
                weight => weight.id == this.$route.params.id
            )[0];
        }
    },
    created() {
        this.getWeight();
    },
    watch: {
        weight() {
            this.getWeight();
        }
    },
    methods: {
        getWeight() {
            if (!this.weight) return false;
            this.form.name_ar = this.weight.name_ar;
            this.form.name_en = this.weight.name_en;
        },
        editWeightData() {
            Api()
                .put(`/admin/weights/${this.$route.params.id}`, this.form)
                .then(res => {
                    this.weightEditedMsg = this.$t(res.data);
                    this.showWeightEditedMsg = true;
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
