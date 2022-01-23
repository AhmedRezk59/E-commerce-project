<template>
    <div>
        <div>
            <div id="wrapper">
                <div class="container mt-5">
                    <div
                        class="alert alert-success"
                        v-if="showDepartmentEditedMsg"
                    >
                        {{ departmentEditedMsg }}
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
                                            {{ $t("Edit Department") }}!
                                        </h1>
                                    </div>
                                    <form
                                        class="user"
                                        @submit.prevent="updateDepartment()"
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
                                                :multiple="false"
                                                allow-batch
                                                :style="
                                                    $i18n.locale == 'ar'
                                                        ? 'position:relative;left:280px'
                                                        : ''
                                                "
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
                                        <div class="form-group row ">
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
                                            {{ $t("Update Department") }}
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
            showDepartmentEditedMsg: false,
            departmentEditedMsg: "",
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
        department() {
            return this.$store.state.departments.filter(
                department => department.id == this.$route.params.id
            )[0];
        },
        treeData() {
            return this.$store.state.departments;
        }
    },
    created() {
        this.getDepartment();
    },
    watch: {
        department() {
            this.getDepartment();
        }
    },
    methods: {
        getDepartment() {
            if (!this.department) return false;
            this.form.name_ar = this.department.text_ar;
            this.form.name_en = this.department.text_en;
            this.form.description = this.department.description;
            this.form.keyword = this.department.keyword;
        },
        updateDepartment() {
            Api()
                .put(`/admin/departments/${this.$route.params.id}`, this.form)
                .then(res => {
                    this.departmentEditedMsg = res.data;
                    this.showDepartmentEditedMsg = true;
                    // this.$store.commit("getDepartments");
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
