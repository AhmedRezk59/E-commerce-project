<template>
    <div>
        <div>
            <div id="wrapper">
                <div class="container mt-5">
                    <div
                        class="alert alert-success"
                        v-if="showDepartmentAddedMsg"
                    >
                        {{ departmentAddedMsg }}
                    </div>
                    <router-link
                        :to="{ name: 'Departments' }"
                        class="btn btn-primary"
                        >{{ $t("Back btn") }}</router-link
                    >
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">
                                            {{ $t("Add Department") }}!
                                        </h1>
                                    </div>
                                    <form
                                        class="user"
                                        @submit.prevent="AddDepartment()"
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
                                                <input
                                                    type="text"
                                                    class="form-control form-control-user"
                                                    id="description"
                                                    name="description"
                                                    :placeholder="
                                                        $t('Description')
                                                    "
                                                    v-model="form.description"
                                                />
                                                <span
                                                    class="text-danger"
                                                    v-if="errors.description"
                                                    >{{
                                                        $t(
                                                            errors
                                                                .description[0]
                                                        )
                                                    }}</span
                                                >
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <v-jstree
                                                :data="
                                                    filterTreeDataChildren(
                                                        treeData
                                                    )
                                                "
                                                show-checkbox
                                                :style="
                                                    $i18n.locale == 'ar'
                                                        ? 'position:relative;left:280px'
                                                        : ''
                                                "
                                                :multiple="false"
                                                allow-batch
                                                whole-row
                                                @item-click="pushId"
                                            ></v-jstree>
                                            <span
                                                class="text-danger"
                                                v-if="errors.parent"
                                                >{{
                                                    $t(errors.parent[0])
                                                }}</span
                                            >
                                        </div>
                                        <div class="form-group row d-block">
                                            <div class="col-sm-12 mb-3 mb-sm-0">
                                                <input
                                                    type="text"
                                                    class="form-control form-control-user"
                                                    id="keyword"
                                                    name="keyword"
                                                    :placeholder="
                                                        $t('Keywords')
                                                    "
                                                    v-model="form.keyword"
                                                />
                                                <span
                                                    class="text-danger"
                                                    v-if="errors.keyword"
                                                    >{{
                                                        $t(errors.keyword[0])
                                                    }}</span
                                                >
                                            </div>
                                        </div>

                                        <button
                                            type="submit"
                                            class="btn btn-primary btn-user btn-block"
                                        >
                                            {{ $t("Add Department") }}
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
import VJstree from "vue-jstree";

export default {
    components: { VJstree },
    data() {
        return {
            showDepartmentAddedMsg: false,
            departmentAddedMsg: "",
            form: {
                name_ar: "",
                name_en: "",
                description: "",
                parent: "",
                keyword: ""
            },
            errors: []
        };
    },

    computed: {
        treeData() {
            return this.$store.state.departments;
        }
    },
    methods: {
        AddDepartment() {
            Api()
                .post("/admin/departments", this.form)
                .then(res => {
                    this.departmentAddedMsg = this.$t(res.data);
                    this.showDepartmentAddedMsg = true;
                    this.$store.commit("getDepartemnts");
                })
                .catch(error => {
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors;
                    }
                });
        },

        pushId(node, item) {
            this.form.parent = item.id;
        },
        adaptTreeData(d) {
            let lang = this.$i18n.locale;
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

<style></style>
