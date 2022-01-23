<template>
    <div>
        <label class="h2">{{ $t("Main photo") }}</label>
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
        <span class="text-danger" v-if="errors.photo">{{
            $t(errors.photo[0])
        }}</span>
        <hr />
        <h2>
            {{ $t("Product media") }}
        </h2>
        <vue-dropzone
            ref="myVueDropzone"
            id="dropzone"
            :options="dropzoneOptions"
            :useCustomSlot="true"
            v-on:vdropzone-file-added="uploadSuccess"
            @vdropzone-removed-file="cancelUpload"
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
import vue2Dropzone from "vue2-dropzone";
import "vue2-dropzone/dist/vue2Dropzone.min.css";
export default {
    props: ["form", "errors"],
    components: {
        vueDropzone: vue2Dropzone
    },
    data() {
        return {
            dropzoneOptions: {
                url: "/api/admin/products/files",
                addRemoveLinks: true,
                maxFilesize: 5,
                autoQueue: false,
                headers: {
                    Authorization: `Bearer ${localStorage.getItem("token")}`
                }
            },
            files: []
        };
    },
    methods: {
        onChange(event) {
            this.$emit("changeForm", {
                label: "photo",
                value: event.target.files[0]
            });
        },
        uploadSuccess(file, response) {
            this.files.push(file);
            this.$emit("changeDropzone", {
                label: "files",
                value: this.files
            });
        },
        cancelUpload() {
            this.files = this.$refs.myVueDropzone.getAcceptedFiles();
            this.$emit("changeDropzone", {
                label: "files",
                value: this.files
            });
        }
    }
};
</script>

<style></style>
