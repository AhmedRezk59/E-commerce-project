<template>
    <div>
        <form @submit.prevent="updatePhoto()" enctype="multipart/form-data">
            <label class="h2">{{ $t("Main photo") }}</label>
            <div
                class="alert alert-success font-weight-bold"
                v-show="showProductLogoEditedMsg"
            >
                {{ $t("productLogoEditedMsg") }}
            </div>
            <div class="custom-file">
                <input
                    type="file"
                    class="custom-file-input"
                    id="customFile"
                    :placeholder="$t('Photo')"
                    @change="onChange"
                />
                <label
                    class="custom-file-label"
                    for="customFile"
                    :class="$i18n.locale == 'ar' ? 'text-center' : ''"
                    >{{ $t("Choose file") }}</label
                >
            </div>
            <span class="text-danger d-block" v-if="errors.photo">{{
                $t(errors.photo[0])
            }}</span>
            <button type="submit" class="btn btn-primary mt-2">
                {{ $t("Update Product Logo") }}
            </button>
        </form>
        <hr />
        <h2>
            {{ $t("Product media") }}
        </h2>
        <div
            class="alert alert-success font-weight-bold"
            v-show="deleteFileShow"
        >
            {{ $t("File deleted Successfully") }}
        </div>
        <vue-dropzone
            ref="myVueDropzone"
            id="dropzone"
            :options="dropzoneOptions"
            :useCustomSlot="true"
            v-on:vdropzone-file-added="doUpload ? uploadFile : false"
            @vdropzone-removed-file="deleteFile"
            duplicateCheck
        >
            <div class="dropzone-custom-content">
                <h3 class="dropzone-custom-title">
                    {{ $t("Drag and drop to upload content") }}!
                </h3>
                <div class="subtitle">...{{ $t("or click") }}</div>
            </div>
        </vue-dropzone>
    </div>
</template>

<script>
import Api from "../../../api/api";
import vue2Dropzone from "vue2-dropzone";
import "vue2-dropzone/dist/vue2Dropzone.min.css";
export default {
    props: ["files"],
    data() {
        return {
            dropzoneOptions: {
                url:
                    "/api/admin/products/file/" +
                    this.$route.params.id +
                    "/upload",
                addRemoveLinks: true,
                maxFilesize: 5,
                autoQueue: true,
                headers: {
                    Authorization: `Bearer ${localStorage.getItem("token")}`
                }
            },
            doUpload: false,
            form: { photo: "" },
            deleteFileShow: false,
            showProductLogoEditedMsg: false,
            errors: []
        };
    },
    components: {
        vueDropzone: vue2Dropzone
    },
    mounted() {
        this.addFiles();
    },
    watch: {
        files() {
            this.addFiles();
        }
    },
    methods: {
        onChange(event) {
            this.form.photo = event.target.files[0];
        },
        uploadFile(file, response) {
            let formData = new FormData();
            const config = {
                headers: {
                    "Content-Type": "multipart/form-data"
                }
            };

            formData.append("id", this.$route.params.id);
            formData.append("file", file);
            Api()
                .post(
                    "/admin/products/file/" + this.$route.params.id + "/upload",
                    formData,
                    config
                )
                .then(() => {
                    this.$store.commit("getProducts");
                })
                .catch(error => {
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors;
                    }
                });
        },
        updatePhoto() {
            let formData = new FormData();
            const config = {
                headers: {
                    "Content-Type": "multipart/form-data"
                }
            };

            formData.append("photo", this.form.photo);
            formData.append("_method", "PUT");
            Api()
                .post(
                    "/admin/products/" + this.$route.params.id + "/updatePhoto",
                    formData,
                    config
                )
                .then(() => {
                    this.showProductLogoEditedMsg = true;
                    this.$store.commit("getProducts");
                })
                .catch(error => {
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors;
                    }
                });
        },
        deleteFile(file, error, xhr) {
            Api()
                .delete(
                    "/admin/products/file/" +
                        file.name +
                        "/delete/" +
                        this.$route.params.id
                )
                .then(res => {
                    this.deleteFileShow = true;
                    this.$store.commit("getProducts");
                })
                .catch(error => {
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors;
                    }
                });
        },
        addFiles() {
            this.files.forEach(file => {
                var added_file = {
                    size: file.size,
                    name: file.name,
                    type: file.type
                };
                var url =
                    "/upload/products/files/" +
                    this.$route.params.id +
                    "/" +
                    file.name;
                this.$refs.myVueDropzone.manuallyAddFile(added_file, url);
            });
            this.doUpload = true;
        }
    }
};
</script>

<style></style>
