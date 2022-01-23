<template>
    <div>
        <h1
            class="text-center"
            v-if="new_sizes.length == 0 && form.department_id == ''"
        >
            {{ $t("show department sizes") }}
        </h1>
        <h1
            class="text-center"
            v-if="new_sizes.length == 0 && form.department_id != ''"
        >
            {{ $t("Please Add sizes to this department") }}
        </h1>
        <hr />
        <h1 class="text-center" v-if="weights.length == 0">
            {{ $t("Please Add weights") }}
        </h1>
        <!-- sizes -->
        <div class="form-group row" v-if="new_sizes.length > 0">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="size_id" class=" font-weight-bold text-dark">{{
                    $t("size type")
                }}</label>
                <select
                    class="form-control form-control-lg"
                    id="size_id"
                    name="size_id"
                    @change="
                        $emit('changeForm', {
                            label: 'size_id',
                            value: $event.target.value
                        })
                    "
                    v-model="form.size_id"
                >
                    <option value="" disabled selected>{{
                        $t("Please Choose a Size")
                    }}</option>
                    <option
                        v-for="size in new_sizes"
                        :key="size.id"
                        :value="size.id"
                        >{{
                            $i18n.locale == "ar" ? size.name_ar : size.name_en
                        }}</option
                    >
                </select>
                <span class="text-danger" v-if="errors.size_id">{{
                    $t(errors.size_id[0])
                }}</span>
            </div>
            <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="size" class=" font-weight-bold text-dark">{{
                    $t("Size")
                }}</label>

                <input
                    class="form-control form-control-lg"
                    type="text"
                    id="size"
                    name="size"
                    :placeholder="$t('Size')"
                    v-model="form.size"
                    @change="
                        $emit('changeForm', {
                            label: 'size',
                            value: $event.target.value
                        })
                    "
                />

                <span class="text-danger" v-if="errors.size">{{
                    $t(errors.size[0])
                }}</span>
            </div>
        </div>
        <!-- end sizes -->
        <!-- weights -->
        <div class="form-group row ">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="weight_id" class=" font-weight-bold text-dark">{{
                    $t("weight type")
                }}</label>
                <select
                    class="form-control form-control-lg"
                    id="weight_id"
                    name="weight_id"
                    v-model="form.weight_id"
                    @change="
                        $emit('changeForm', {
                            label: 'weight_id',
                            value: $event.target.value
                        })
                    "
                >
                    <option value="" disabled selected>{{
                        $t("Please Choose a Weight")
                    }}</option>
                    <option
                        v-for="weight in weights"
                        :key="weight.id"
                        :value="weight.id"
                        >{{
                            $i18n.locale == "ar"
                                ? weight.name_ar
                                : weight.name_en
                        }}</option
                    >
                </select>
                <span class="text-danger" v-if="errors.weight_id">{{
                    $t(errors.weight_id[0])
                }}</span>
            </div>
            <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="weight" class=" font-weight-bold text-dark">{{
                    $t("Weight")
                }}</label>

                <input
                    class="form-control form-control-lg"
                    type="text"
                    id="weight"
                    name="weight"
                    :placeholder="$t('Weight')"
                    v-model="form.weight"
                    @change="
                        $emit('changeForm', {
                            label: 'weight',
                            value: $event.target.value
                        })
                    "
                />

                <span class="text-danger" v-if="errors.weight">{{
                    $t(errors.weight[0])
                }}</span>
            </div>
        </div>
        <!-- end weights -->
        <!-- colors & trademarks-->
        <div class="form-group row">
            <!-- colors -->
            <h2 class="col-sm-6 mb-3 mb-sm-0" v-if="colors.length == 0">
                {{ $t("Please Add colors to choose from") }}
            </h2>
            <div class="col-sm-6 mb-3 mb-sm-0" v-if="colors.length > 0">
                <label for="color_id" class=" font-weight-bold text-dark">{{
                    $t("Color")
                }}</label>
                <select
                    class="form-control form-control-lg"
                    id="color_id"
                    name="color_id"
                    v-model="form.color_id"
                    @change="
                        $emit('changeForm', {
                            label: 'color_id',
                            value: $event.target.value
                        })
                    "
                >
                    <option value="" disabled selected>{{
                        $t("Please Choose a Color")
                    }}</option>
                    <option
                        v-for="color in colors"
                        :key="color.id"
                        :value="color.id"
                        >{{
                            $i18n.locale == "ar" ? color.name_ar : color.name_en
                        }}</option
                    >
                </select>
                <span class="text-danger" v-if="errors.color_id">{{
                    $t(errors.color_id[0])
                }}</span>
            </div>
            <!-- end colors -->
            <!-- trademarks -->
            <h2 class="col-sm-6 mb-3 mb-sm-0" v-if="trademarks.length == 0">
                {{ $t("Please Add trademarks to choose from") }}
            </h2>
            <div class="col-sm-6 mb-3 mb-sm-0" v-if="trademarks.length > 0">
                <label for="trademark_id" class=" font-weight-bold text-dark">{{
                    $t("Trademark")
                }}</label>
                <select
                    class="form-control form-control-lg"
                    id="trademark_id"
                    name="trademark_id"
                    v-model="form.trademark_id"
                    @change="
                        $emit('changeForm', {
                            label: 'trademark_id',
                            value: $event.target.value
                        })
                    "
                >
                    <option value="" disabled selected>{{
                        $t("Please Choose a Trademark")
                    }}</option>
                    <option
                        v-for="trademark in trademarks"
                        :key="trademark.id"
                        :value="trademark.id"
                        >{{ trademark.name }}</option
                    >
                </select>
                <span class="text-danger" v-if="errors.trademark_id">{{
                    $t(errors.trademark_id[0])
                }}</span>
            </div>
        </div>
        <!-- end colors & trademarks -->
    </div></template
>

<script>
export default {
    props: ["errors", "form"],
    data: () => {
        return {
            list_departments: [],
            new_sizes: []
        };
    },
    computed: {
        weights() {
            return this.$store.state.weights;
        },
        colors() {
            return this.$store.state.colors;
        },
        trademarks() {
            return this.$store.state.trademarks;
        },

        sizes() {
            return this.$store.state.sizes;
        },
        department() {
            return this.departments.filter(
                department => department.id == this.form.department_id
            )[0];
        },
        departments() {
            return this.$store.state.departments;
        },
        department_id() {
            return this.form.department_id;
        }
    },
    watch: {
        department_id() {
            this.new_sizes = this.getDepartmentSizes(this.department_id);
        }
    },
    created() {
        this.new_sizes = this.getDepartmentSizes(this.department_id);
    },
    methods: {
        getDepartmentSizes(department_id) {
            if (!this.department) return '';
            this.list_departments.length = 0;
            this.list_departments.push(department_id);
            let parent = this.department.parent;
            if (parent != null) {
                this.list_departments.push(parent);
                this.getDepartmentParent(parent);
            }
            let newSizes = this.sizes.filter(
                size =>
                    size.department_id == this.form.department_id ||
                    (this.list_departments.includes(size.id) &&
                        size.is_public == "yes")
            );
            return newSizes;
        },
        getDepartmentParent(department_id) {
            let department = this.departments.filter(
                department => department.id == department_id
            )[0];
            let parent = department.parent;
            if (parent != null) {
                this.list_departments.push(parent);
                this.getDepartmentParent(parent);
            }
        }
    }
};
</script>

<style></style>
