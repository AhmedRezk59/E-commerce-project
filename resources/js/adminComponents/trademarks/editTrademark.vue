<template>
    <div>
        <div>
            <div id="wrapper">
                <div class="container mt-5">
                    <div
                        class="alert alert-success"
                        v-if="showTrademarkEditedMsg"
                    >
                        {{ trademarkEditedMsg }}
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
                                            {{ $t("Edit a Trademark") }}!
                                        </h1>
                                    </div>
                                    <form
                                        class="user"
                                        @submit.prevent="editTrademarkData()"
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

                                        <button
                                            type="submit"
                                            class="btn btn-primary btn-user btn-block"
                                        >
                                            {{ $t("Update Trademark") }}
                                        </button>
                                    </form>
                                    <hr />
                                    <form
                                        @submit.prevent="editTrademarkLogo()"
                                        enctype="multipart/form-data"
                                    >
                                        <h3
                                            class="text-center text-gray-900 mb-4"
                                        >
                                            {{ $t("Update Trademark Logo") }}
                                        </h3>
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
                                            {{ $t("Update Trademark Logo") }}
                                        </button>
                                    </form>
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
            showTrademarkEditedMsg: false,
            trademarkEditedMsg: "",
            form: {
                name: "",
                logo: ""
            },
            errors: []
        };
    },
    created() {
        this.getTrademark();
    },
    watch: {
        trademark() {
            this.getTrademark();
        }
    },
    computed: {
        trademark() {
            return this.$store.state.trademarks.filter(
                tradmark => tradmark.id == this.$route.params.id
            )[0];
        }
    },
    methods: {
        onChange(event) {
            this.form.logo = event.target.files[0];
        },

        getTrademark() {
            if (!this.trademark) return false;

            this.form.name = this.trademark.name;
        },
        editTrademarkData() {
            Api()
                .put(`/admin/trademarks/${this.$route.params.id}`, this.form)
                .then(res => {
                    this.trademarkEditedMsg = this.$t(res.data);
                    this.showTrademarkEditedMsg = true;
                    this.$store.commit("getTrademarks");
                })
                .catch(error => {
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors;
                    }
                });
        },
        editTrademarkLogo() {
            let formData = new FormData();

            const config = {
                headers: {
                    "Content-Type": "multipart/form-data"
                }
            };
            formData.append("logo", this.form.logo);
            formData.append("_method", "PUT");
            Api()
                .post(
                    `/admin/trademarks/${this.$route.params.id}/updateLogo`,
                    formData,
                    config
                )
                .then(res => {
                    this.trademarkEditedMsg = this.$t(res.data);
                    this.showTrademarkEditedMsg = true;
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
