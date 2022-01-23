<template>
    <div>
        <v-jstree
            :data="filterTreeDataChildren(treeData)"
            allow-batch
            whole-row
            :style="
                $i18n.locale == 'ar'
                    ? 'float:right ;clear:both;margin-right:50px;'
                    : ''
            "
            @item-click="pushId"
        ></v-jstree>
        <span class="text-danger" v-if="errors.department_id">{{
            $t(errors.department_id[0])
        }}</span>
    </div>
</template>

<script>
import VJstree from "vue-jstree";

export default {
    props: ["errors", "form"],
    components: {
        VJstree
    },
    computed: {
        treeData() {
            return this.$store.state.departments;
        }
    },
    methods: {
        pushId(node) {
            this.$emit("changeForm", {
                label: "department_id",
                value: node.model.id
            });
        },
        adaptTreeData(data) {
            let lang = this.$i18n.locale;
            return data.map(department => {
                return {
                    id: department.id,
                    text:
                        lang == "ar" ? department.text_ar : department.text_en,
                    parent: department.parent,
                    children: this.adaptTreeData(department.children),
                    opened: department.opened
                };
            });
        },

        filterTreeDataChildren(data) {
            return this.adaptTreeData(data).filter(department =>
                !department.parent ? department : false
            );
        }
    }
};
</script>

<style></style>
