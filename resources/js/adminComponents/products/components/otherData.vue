<template>
    <div class="form-group row ">
        <div class="col-sm-12 mb-3 mb-sm-0">
            <label for="other_data" class=" font-weight-bold text-dark">{{
                $t("Other data")
            }}</label>
            <textarea
                type="text"
                class="form-control form-control-user"
                id="other_data"
                name="other_data"
                cols="30"
                rows="9"
                :placeholder="$t('Other data')"
                @change="
                    $emit('changeForm', {
                        label: 'other_data',
                        value: $event.target.value
                    })
                "
                v-model="form.other_data"
            >
            </textarea>
            <span class="text-danger" v-if="errors.other_data">{{
                $t(errors.other_data[0])
            }}</span>
        </div>
    </div>
</template>

<script>
export default {
    props: ["errors", "form"]
};
</script>

<style></style>
