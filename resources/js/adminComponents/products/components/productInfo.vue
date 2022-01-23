<template>
    <div>
        <div class="form-group row ">
            <div class="col-sm-12 mb-3 mb-sm-0">
                <label for="title" class=" font-weight-bold text-dark">{{
                    $t("Title")
                }}</label>
                <input
                    type="text"
                    class="form-control form-control-user"
                    id="title"
                    name="title"
                    :placeholder="$t('Title')"
                    v-model="form.title"
                    @change="
                        $emit('changeForm', {
                            label: 'title',
                            value: $event.target.value
                        })
                    "
                />
                <span class="text-danger" v-if="errors.title">{{
                    $t(errors.title[0])
                }}</span>
            </div>
        </div>
        <div class="form-group row ">
            <div class="col-sm-12 mb-3 mb-sm-0">
                <label for="content" class=" font-weight-bold text-dark">{{
                    $t("Content")
                }}</label>
                <textarea
                    type="text"
                    class="form-control form-control-user"
                    id="content"
                    name="content"
                    cols="30"
                    rows="9"
                    :placeholder="$t('Content')"
                    v-model="form.content"
                    @change="
                        $emit('changeForm', {
                            label: 'content',
                            value: $event.target.value
                        })
                    "
                >
                </textarea>
                <span class="text-danger" v-if="errors.content">{{
                    $t(errors.content[0])
                }}</span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["form", "errors"]
};
</script>

<style></style>
