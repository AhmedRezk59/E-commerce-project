<template>
    <div>
        <div class="alert alert-success" v-if="showDeleteMsgSuccess">
            {{ deleteMsgSuccess }}
        </div>
        <router-link
            :to="{ name: 'CreateDepartment' }"
            class="btn btn-primary mb-3 float-left clearfix"
            v-if="is_super == 1"
            >{{ $t("Add Department") }}</router-link
        >
        <router-link
            v-if="form.id && is_super == 1"
            :to="{ name: 'EditDepartment', params: { id: form.id } }"
            class="btn btn-success mb-3 float-left clearfix mx-2"
            >{{ $t("Edit Department") }}</router-link
        >
        <button
            v-if="form.id && is_super == 1"
            id="deleteBtn"
            class="btn btn-danger mb-3 float-left clearfix"
            data-toggle="modal"
            data-target="#exampleModal"
        >
            {{ $t("Delete Department") }}
        </button>
        <!-- modal -->
        <div
            class="modal fade"
            id="exampleModal"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            {{ $t("Delete sub Department") }}
                            {{ $t("Department") }} {{ form.text }}{{ $t("?") }}
                            <div class="text-danger">
                                {{ $t("sub department warning") }}!
                            </div>
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            {{ $t("Close modal") }}
                        </button>
                        <button
                            type="button"
                            class="btn btn-primary"
                            @click.prevent="deleteDepartment()"
                        >
                            {{ $t("Delete modal") }}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- end modal -->
        <v-jstree
            :data="filterTreeDataChildren(treeData)"
            allow-batch
            whole-row
            :style="
                $i18n.locale == 'ar'
                    ? 'float:right ;clear:both;margin-right:50px'
                    : ''
            "
            @item-click="pushId"
        ></v-jstree>
    </div>
</template>

<script>
import Api from "../../api/api";
import VJstree from "vue-jstree";

export default {
    components: {
        VJstree
    },
    data() {
        return {
            showDeleteMsgSuccess: false,
            deleteMsgSuccess: "",
            form: { id: "", text: "" },
            is_super: ""
        };
    },
    created() {
        this.adaptTreeData();
    },
    mounted() {
        this.is_super = JSON.parse(
            localStorage.getItem("authnticated admin")
        ).is_super;
    },

    computed: {
        treeData() {
            return this.$store.state.departments;
        }
    },
    methods: {
        pushId(node) {
            this.form.id = node.model.id;
            this.form.text = node.model.text;
        },
        deleteDepartment() {
            Api()
                .delete("/admin/departments/" + this.form.id)
                .then(res => {
                    $("#exampleModal").modal("hide");
                    this.showDeleteMsgSuccess = true;
                    this.deleteMsgSuccess = this.$t(res.data);
                    this.$store.commit("getDepartments");
                    this.form.id = "";
                })
                .catch(error => console.error(error));
        },
        adaptTreeData(d) {
            let lang = this.$i18n.locale;
            if (!d) return false;
            return d.map(element => {
                return {
                    id: element.id,
                    text: lang == "ar" ? element.text_ar : element.text_en,
                    parent: element.parent,
                    children: this.adaptTreeData(element.children),
                    opened: element.opened
                };
            });
        },

        filterTreeDataChildren(d) {
            return this.adaptTreeData(d).filter(element =>
                !element.parent ? element : false
            );
        }
    }
};
</script>
