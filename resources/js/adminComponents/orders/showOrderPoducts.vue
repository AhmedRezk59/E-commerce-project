<template>
    <div>
        <h1>{{ $t("Products") }}</h1>

        <table class="table text-center">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">
                        #
                    </th>
                    <th scope="col">{{ $t("title") }}</th>
                    <th scope="col">{{ $t("stock") }}</th>
                    <th scope="col">{{ $t("price") }}</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="row in rows" :key="row.id">
                    <th>
                        <span>{{ rows.indexOf(row) + 1 }}</span>
                    </th>
                    <td>{{ row.title }}</td>
                    <td>{{ row.stock }}</td>
                    <td>
                        {{
                            checkDates(row.start_offer_at, row.end_offer_at)
                                ? row.price_offer
                                : row.price
                        }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    props: { rows: { required: true, type: Array } },
    methods: {
        checkDates(start_offer_at, end_offer_at) {
            return (
                new Date(start_offer_at).getTime() <= this.currentDate &&
                new Date(end_offer_at).getTime() >= this.currentDate
            );
        }
    }
};
</script>

<style></style>
