<template>
    <div>
        <div class="alert alert-success" v-if="showDeleteMsgSuccess">
            {{ deleteMsgSuccess }}
        </div>

        <a class="btn btn-info" @click.prevent="createPDF()">{{
            $t("Export as PDF")
        }}</a>
        <export-excel
            :data="reloadedRows"
            class="btn btn-success"
            type="xls"
            :name="name + '.xls'"
        >
            {{ $t("Export as Excel") }}
        </export-excel>

        <button
            id="deleteBtn"
            class="btn btn-danger"
            data-toggle="modal"
            data-target="#deleteChecked"
            v-if="is_super == 1"
        >
            {{ $t("Delete Checked") }}
        </button>
        <div
            class="modal fade"
            id="deleteChecked"
            tabindex="-1"
            role="dialog"
            aria-labelledby="deleteAllModal"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteAllModal">
                            {{ $t("Delete All checked Rows") }}
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
                    <div class="modal-body" v-if="checkedRows.length == 0">
                        <span class="text-info lead font-weight-bold">{{
                            $t("You should check Rows first!")
                        }}</span>
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
                            v-if="checkedRows.length > 0"
                            @click.prevent="deleteAll()"
                        >
                            {{ $t("Delete modal") }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-block my-3 col-md-6 col-xs-12">
            <form
                class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"
            >
                <div class="input-group">
                    <input
                        type="text"
                        class="form-control bg-light border-2 small"
                        placeholder="Search for..."
                        aria-label="Search"
                        aria-describedby="basic-addon2"
                        v-model="search"
                    />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-xs-12 table-responsive text-center">
            <table
                class="table table-striped table-bordered table-hover"
                id="myTable"
            >
                <thead>
                    <tr>
                        <th
                            v-for="(column, index) in columns"
                            :key="index"
                            v-show="
                                (is_super == 1 &&
                                    column.label == 'Check All') ||
                                    column.label != 'Check All'
                            "
                        >
                            {{ $t(column.label) }}

                            <div
                                v-if="column.label == 'Check All'"
                                class="d-inline"
                            >
                                <input
                                    type="checkbox"
                                    id="checkAll"
                                    @click="checkAllRows = !checkAllRows"
                                    v-model="checkAllRows"
                                />
                            </div>
                        </th>
                        <th v-if="buttons && is_super == 1">
                            {{ $t("Action") }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="reloadedRows.length == 0">
                        <td
                            :colspan="columns.length + 1"
                            class="font-weight-bold"
                        >
                            {{ $t("There is no data") }}
                        </td>
                    </tr>
                    <tr v-for="row in reloadedRows" :key="row.id">
                        <td v-for="(item, index) in row" :key="index">
                            <span
                                v-if="
                                    item != row.id &&
                                        item != row.logo &&
                                        item != row.color &&
                                        item != row.department &&
                                        item != row.color &&
                                        item != row.photo &&
                                        item != row.super
                                "
                                >{{ item }}</span
                            >
                            <span v-if="item == row.id">{{
                                reloadedRows.indexOf(row) + 1
                            }}</span>

                            <span v-if="item == row.department">{{
                                $i18n.locale == "ar"
                                    ? item.text_ar
                                    : item.text_en
                            }}</span>
                            <span v-if="item == row.color">{{
                                $i18n.locale == "ar"
                                    ? item.name_ar
                                    : item.name_en
                            }}</span>
                            <span
                                v-if="item == row.color"
                                class="d-inline-block text-center rounded-circle"
                                :style="
                                    `width:30px; height:30px;background-color:${item}`
                                "
                            ></span>
                            <span v-if="item == row.logo && item != null"
                                ><img
                                    :src="
                                        '/upload/' +
                                            deleteRoute +
                                            '/logos/' +
                                            row.id +
                                            '/' +
                                            row.logo
                                    "
                                    width="50px"
                            /></span>
                            <span v-if="item == row.photo && item != null"
                                ><img
                                    :src="
                                        '/upload/' +
                                            deleteRoute +
                                            '/logos/' +
                                            row.id +
                                            '/' +
                                            item
                                    "
                                    width="50px"
                            /></span>
                        </td>
                        <td v-if="is_super == 1">
                            <input
                                type="checkbox"
                                class="form-control form-control-sm"
                                :value="row.id"
                                v-model="checkedRows"
                            />
                        </td>
                        <td
                            v-if="buttons && is_super == 1"
                            class="d-flex justify-content-center"
                        >
                            <span v-if="buttons.edit">
                                <router-link
                                    :to="{
                                        name: buttons.edit.routeName,
                                        params: { id: row.id }
                                    }"
                                    class="btn btn-primary"
                                    >{{ $t("Edit btn") }}</router-link
                                >
                            </span>
                            <span v-if="buttons.delete">
                                <button
                                    @click="showDeleteModal(row.id)"
                                    id="deleteBtn"
                                    class="btn btn-danger ml-1"
                                    data-toggle="modal"
                                    data-target="#exampleModal"
                                >
                                    {{ $t("Delete btn") }}
                                </button>
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
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
                                {{ $t("Delete one") }} {{ $t(name)
                                }}{{ $t("?") }}
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
                        <div class="modal-body d-none">
                            <form>
                                <input
                                    type="hidden"
                                    v-model="form.id"
                                    value=""
                                    id="id"
                                />
                            </form>
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
                                @click.prevent="deleteSpecificRow()"
                            >
                                {{ $t("Delete modal") }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal -->
            <div class="col-xs-12 form-inline" v-if="reloadedRows.length != 0">
                <label for="pager" class="lead mr-2"
                    >{{ $t("Navigation") }}:
                </label>
                <select class="d-flex form-control" v-model="page" id="pager">
                    <option value="0">Show All</option>
                    <option
                        v-for="index in +numberOfPages"
                        :key="index"
                        :value="index"
                    >
                        {{ index }}
                    </option>
                </select>
            </div>
        </div>
    </div>
</template>

<script>
import Api from "../../api/api";
import jsPDF from "jspdf";
import "jspdf-autotable";

export default {
    props: {
        columns: { type: Array, required: true },
        buttons: [Boolean, Object],
        rows: { type: Array, required: true },
        name: { type: String, required: true },
        deleteRoute: { type: String, required: true },
        mutation: { type: String, required: true }
    },
    data() {
        return {
            search: "",
            page: 1,
            checkAllRows: false,
            checkedRows: [],
            form: {
                id: ""
            },
            showDeleteMsgSuccess: false,
            deleteMsgSuccess: "",
            is_super: ""
        };
    },
    mounted() {
        this.is_super = JSON.parse(
            localStorage.getItem("authnticated admin")
        ).is_super;
    },
    computed: {
        numberOfPages() {
            return Math.ceil(this.resultQuery.length / 10);
        },
        sorts() {
            return this.columns
                .filter(c => c.sortable_label != null)
                .map(c => c.sortable_label);
        },
        reloadedRows() {
            if (this.page == 0) {
                return this.resultQuery;
            }
            let newRows = this.resultQuery.filter(row => {
                return (
                    this.resultQuery.indexOf(row) >= this.page * 10 - 10 &&
                    this.resultQuery.indexOf(row) < this.page * 10
                );
            });
            return newRows;
        },

        resultQuery() {
            if (!this.search) {
                return this.rows;
            }
            let newRows = [];
            this.rows.forEach(row => {
                var filtered;
                this.sorts.forEach(sort => {
                    filtered =
                        filtered ||
                        this.search
                            .toLowerCase()
                            .split(" ")
                            .every(v => row[sort].toLowerCase().includes(v));
                });
                if (filtered) newRows.push(row);
            });
            this.page = 1;
            return newRows;
        }
    },

    watch: {
        checkAllRows() {
            this.toggleAllRows();
        }
    },
    methods: {
        toggleAllRows() {
            if (this.checkAllRows) {
                this.reloadedRows.forEach(element => {
                    this.checkedRows.push(element.id);
                });
            } else {
                this.checkedRows = [];
            }
        },

        exportExcel() {
            Api()
                .get("/admin/export")
                .then(() => console.log("downloaded"))
                .catch(err => console.error(err));
        },
        createPDF() {
            const doc = new jsPDF();

            doc.autoTable({ html: "#myTable" });

            doc.save(this.name + ".pdf");
        },

        deleteSpecificRow() {
            Api()
                .delete(
                    `/admin/${this.deleteRoute}/` +
                        document.getElementById("id").value
                )
                .then(res => {
                    $("#exampleModal").modal("hide");
                    this.showDeleteMsgSuccess = true;
                    this.deleteMsgSuccess = this.$t(res.data);
                    this.$store.commit(this.mutation);
                })
                .catch(error => console.error(error));
        },
        deleteAll() {
            Api()
                .delete(`/admin/${this.deleteRoute}/destroy/all`, {
                    data: {
                        checkedRows: this.checkedRows
                    }
                })
                .then(res => {
                    $("#deleteChecked").modal("hide");
                    this.showDeleteMsgSuccess = true;
                    this.deleteMsgSuccess = this.$t(res.data);
                    this.$store.commit(this.mutation);
                    this.page -= 1;
                    this.checkAllRows = false;
                    this.checkedRows = [];
                })
                .catch(error => console.error(error));
        },
        showDeleteModal(id) {
            document.getElementById("id").value = id;
        }
    }
};
</script>

<style>
#deleteBtn {
    outline: none;
    border: none;
}
</style>
