<template>
    <div>
        <div class="form-group d-md-flex">
            <div class="col-md-5 col-xs-12 mb-3 mb-sm-0">
                <label for="price" class=" font-weight-bold text-dark">{{
                    $t("Price")
                }}</label>
                <input
                    type="text"
                    class="form-control form-control-user mb-2"
                    id="price"
                    name="price"
                    :placeholder="$t('Price')"
                    v-model="form.price"
                    @change="
                        $emit('changeForm', {
                            label: 'price',
                            value: $event.target.value
                        })
                    "
                />
                <span class="text-danger" v-if="errors.price">{{
                    $t(errors.price[0])
                }}</span>
            </div>

            <div class="col-md-5 col-xs-12 mb-3 mb-sm-0">
                <label for="stock" class=" font-weight-bold text-dark">{{
                    $t("Stock")
                }}</label>
                <input
                    type="text"
                    class="form-control form-control-user  mb-2"
                    id="stock"
                    name="stock"
                    :placeholder="$t('Stock')"
                    v-model="form.stock"
                    @change="
                        $emit('changeForm', {
                            label: 'stock',
                            value: $event.target.value
                        })
                    "
                />
                <span class="text-danger" v-if="errors.stock">{{
                    $t(errors.stock[0])
                }}</span>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-5 col-xs-12  mb-3 mb-sm-0 d-md-inline-block">
                <label for="start_at" class=" font-weight-bold text-dark">{{
                    $t("Start at")
                }}</label>

                <datepicker
                    v-model="form.start_at"
                    format="dd-MM-yyyy"
                    bootstrap-styling
                    typeable
                    calendar-button
                    calendar-button-icon="far fa-calendar-alt"
                    :placeholder="$t('Start at')"
                    name="start_at"
                    id="start_at"
                    @change="
                        $emit('changeForm', {
                            label: 'start_at',
                            value: $event.target.value
                        })
                    "
                ></datepicker>
                <span class="text-danger" v-if="errors.start_at">{{
                    $t(errors.start_at[0])
                }}</span>
            </div>
            
        </div>
        <div class="form-group d-block">
            <div class="col-md-5 col-xs-12 mb-3 mb-sm-0">
                <label for="price_offer" class=" font-weight-bold text-dark">{{
                    $t("Price offer")
                }}</label>
                <input
                    type="text"
                    class="form-control form-control-user  mb-2"
                    id="price_offer"
                    name="price_offer"
                    :placeholder="$t('Price offer')"
                    v-model="form.price_offer"
                    @change="
                        $emit('changeForm', {
                            label: 'price_offer',
                            value: $event.target.value
                        })
                    "
                />
                <span class="text-danger" v-if="errors.price_offer">{{
                    $t(errors.price_offer[0])
                }}</span>
            </div>
            <div class="col-md-5 col-xs-12 mb-3 mb-sm-0 d-md-inline-block">
                <label
                    for="start_offer_at"
                    class=" font-weight-bold text-dark"
                    >{{ $t("Start offer at") }}</label
                >

                <datepicker
                    v-model="form.start_offer_at"
                    typeable
                    format="dd-MM-yyyy"
                    bootstrap-styling
                    calendar-button
                    calendar-button-icon="far fa-calendar-alt"
                    :placeholder="$t('Start offer at')"
                    name="start_offer_at"
                    id="start_offer_at"
                    @change="
                        $emit('changeForm', {
                            label: 'start_offer_at',
                            value: $event.target.value
                        })
                    "
                ></datepicker>

                <span class="text-danger" v-if="errors.start_offer_at">{{
                    $t(errors.start_offer_at[0])
                }}</span>
            </div>
            <div class="col-md-5 col-xs-12 mb-3 mb-sm-0 d-md-inline-block">
                <label for="end_offer_at" class=" font-weight-bold text-dark">{{
                    $t("End offer at")
                }}</label>
                <datepicker
                    v-model="form.end_offer_at"
                    format="dd-MM-yyyy"
                    bootstrap-styling
                    :placeholder="$t('End offer at')"
                    calendar-button
                    calendar-button-icon="far fa-calendar-alt"
                    typeable
                    name="end_offer_at"
                    id="end_offer_at"
                    @change="
                        $emit('changeForm', {
                            label: 'end_offer_at',
                            value: $event.target.value
                        })
                    "
                ></datepicker>

                <span class="text-danger" v-if="errors.end_offer_at">{{
                    $t(errors.end_offer_at[0])
                }}</span>
            </div>
        </div>
    </div>
</template>

<script>
import Datepicker from "vuejs-datepicker";
export default {
    props: ["errors", "form"],
    components: {
        Datepicker
    }
};
</script>

<style></style>
