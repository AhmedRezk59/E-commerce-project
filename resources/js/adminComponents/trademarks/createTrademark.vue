<template>
    <div>
        <div>
            <div id="wrapper">
                <div class="container mt-5">
                    <div
                        class="alert alert-success"
                        v-if="showTrademarkAddedMsg"
                    >
                        {{ trademarkAddedMsg }}
                    </div>
                    <router-link
                        :to="{ name: 'Trademarks' }"
                        class="btn btn-primary"
                        >{{ $t("Back btn") }}</router-link
                    >
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">
                                            {{ $t("Add Trademark") }}!
                                        </h1>
                                    </div>
                                    <form
                                        class="user"
                                        @submit.prevent="AddTrademark()"
                                    >
                                        <div class="form-group row ">
                                            <div class="col-sm-12 mb-3 mb-sm-0">
                                                <input
                                                    type="text"
                                                    class="form-control form-control-user"
                                                    id="name"
                                                    name="name"
                                                    :placeholder="$t('Name')"
                                                    v-model="form.name"
                                                />
                                                <span
                                                    class="text-danger"
                                                    v-if="errors.name"
                                                    >{{
                                                        $t(errors.name[0])
                                                    }}</span
                                                >
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-12 mb-3 mb-sm-0">
                                                <input
                                                    type="file"
                                                    class="form-control"
                                                    id="logo"
                                                    name="logo"
                                                    :placeholder="$t('logo')"
                                                    @change="onChange"
                                                />
                                                <span
                                                    class="text-danger"
                                                    v-if="errors.logo"
                                                    >{{
                                                        $t(errors.logo[0])
                                                    }}</span
                                                >
                                            </div>
                                        </div>

                                        <button
                                            type="submit"
                                            class="btn btn-primary btn-user btn-block"
                                        >
                                            {{ $t("Add Trademark") }}
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
            showTrademarkAddedMsg: false,
            trademarkAddedMsg: "",
            form: {
                name: "",
                logo: ""
            },
            errors: []
        };
    },
    methods: {
        onChange(event) {
            this.form.logo = event.target.files[0];
        },
        AddTrademark() {
            let formData = new FormData();

            const config = {
                headers: {
                    "Content-Type": "multipart/form-data"
                }
            };

            formData.append("name", this.form.name);
            formData.append("logo", this.form.logo);
            Api()
                .post("/admin/trademarks", formData, config)
                .then(res => {
                    this.trademarkAddedMsg = this.$t(res.data);
                    this.showTrademarkAddedMsg = true;
                    this.$store.commit("getTrademarks");
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
