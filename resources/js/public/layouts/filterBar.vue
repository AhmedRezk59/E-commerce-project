<template>
    <div class="col-md-2 col-sm-4">
        <div class="filter">
            <button
                class="btn btn-default"
                type="button"
                data-toggle="collapse"
                data-target="#mobile-filter"
                aria-expanded="false"
                aria-controls="mobile-filter"
            >
                Filters<span class="fa fa-filter pl-1"></span>
            </button>
        </div>

        <section id="sidebar">
            <div>
                <h6 class="p-1 border-bottom">{{ $t("Filter By") }}</h6>
                <p class="mb-2">{{ $t("Department") }}</p>
                <ul class="list-group">
                    <li
                        v-for="department in departments"
                        :key="department.id"
                        class="list-group-item list-group-item-action mb-2 rounded"
                    >
                        <input
                            type="checkbox"
                            :id="department.text_en"
                            :value="department.id"
                            v-model="chosenDepartments"
                        />
                        <label :for="department.text_en">{{
                            department["text_" + $i18n.locale]
                        }}</label>
                    </li>
                </ul>
                <p class="mb-2">{{ $t("Trademark") }}</p>
                <ul class="list-group">
                    <li
                        v-for="trademark in trademarks"
                        :key="trademark.id"
                        class="list-group-item list-group-item-action mb-2 rounded"
                    >
                        <input
                            type="checkbox"
                            :id="trademark.name_en"
                            :value="trademark.id"
                            v-model="chosenTrademarks"
                        />
                        <span :for="trademark.name_en">{{
                            trademark.name
                        }}</span>
                    </li>
                </ul>
            </div>
        </section>
    </div>
</template>

<script>
import Api from "../../api/users api";
import EventBus from "../../event";

export default {
    data() {
        return {
            departments: "",
            trademarks: "",
            chosenDepartments: [],
            chosenTrademarks: []
        };
    },
    computed: {
        products() {
            return this.$store.state.products.data;
        },
        minPrice() {},
        maxPrice() {}
    },

    watch: {
        chosenDepartments() {
            EventBus.$emit("paginate", {
                chosenDepartments: this.chosenDepartments,
                chosenTrademarks: this.chosenTrademarks
            });
            this.getProducts();
        },
        chosenTrademarks() {
            EventBus.$emit("paginate", {
                chosenDepartments: this.chosenDepartments,
                chosenTrademarks: this.chosenTrademarks
            });
            this.getProducts();
        }
    },
    created() {
        this.getTrademarks();
        this.getDepartments();
    },
    methods: {
        getTrademarks() {
            Api()
                .get("/trademarks")
                .then(res => (this.trademarks = res.data))
                .catch(error => console.error(error));
        },
        getDepartments() {
            Api()
                .get("/departments")
                .then(res => (this.departments = res.data))
                .catch(error => console.error(error));
        },
        getProducts() {
            Api()
                .get("/get/products", {
                    params: {
                        page: this.page,
                        chosenDepartments: this.chosenDepartments,
                        chosenTrademarks: this.chosenTrademarks
                    }
                })
                .then(res => {
                    this.$store.state.products = res.data;
                })
                .catch(error => console.error(error));
        }
    }
};
</script>

<style scoped>
* {
    box-sizing: border-box;
}

body {
    color: grey;
}

#sidebar {
    padding: 10px;
    margin: 0;
    float: left;
    width: 100%;
}

ul {
    list-style: none;
    padding: 5px;
    width: 90%;
}

li a {
    color: darkgray;
    text-decoration: none;
    width: 90%;
}

li a:hover {
    text-decoration: none;
    color: darksalmon;
}

.fa-circle {
    font-size: 20px;
}

#red {
    color: #e94545d7;
}

#teal {
    color: rgb(69, 129, 129);
}

#blue {
    color: #0000ff;
}

.card {
    width: 250px;
    display: inline-block;
    height: 300px;
}

.card-img-top {
    width: 250px;
    height: 210px;
}

.card-body p {
    margin: 2px;
}

.card-body {
    padding: 0;
    padding-left: 2px;
}

.filter {
    display: none;
    padding: 0;
    margin: 0;
}

@media (min-width: 991px) {
    .navbar-nav {
        margin-left: 35%;
    }

    .nav-item {
        padding-left: 20px;
    }

    .card {
        width: 190px;
        display: inline-block;
        height: 300px;
    }

    .card-img-top {
        width: 188px;
        height: 210px;
    }

    #mobile-filter {
        display: none;
    }
}

@media (min-width: 768px) and (max-width: 991px) {
    .navbar-nav {
        margin-left: 20%;
    }

    .nav-item {
        padding-left: 10px;
    }

    .card {
        width: 230px;
        display: inline-block;
        height: 300px;
        margin-bottom: 10px;
    }

    .card-img-top {
        width: 230px;
        height: 210px;
    }

    #mobile-filter {
        display: none;
    }
}

@media (min-width: 568px) and (max-width: 767px) {
    .navbar-nav {
        margin-left: 20%;
    }

    .nav-item {
        padding-left: 10px;
    }

    .card {
        width: 205px;
        display: inline-block;
        height: 300px;
        margin-bottom: 10px;
    }

    .card-img-top {
        width: 203px;
        height: 210px;
    }

    .fa-circle {
        font-size: 15px;
    }

    #mobile-filter {
        display: none;
    }
}

@media (max-width: 567px) {
    .navbar-nav {
        margin-left: 0%;
    }

    .nav-item {
        padding-left: 10px;
    }

    #sidebar {
        width: 100%;
        padding: 10px;
        margin: 0;
        float: left;
    }

    #products {
        width: 100%;
        padding: 5px;
        margin: 0;
        float: right;
    }

    .card {
        width: 230px;
        display: inline-block;
        height: 300px;
        margin-bottom: 10px;
        margin-top: 10px;
    }

    .card-img-top {
        width: 230px;
        height: 210px;
    }

    .list-group-item {
        padding: 3px;
    }

    .offset-1 {
        margin-left: 8%;
    }

    .filter {
        display: block;
        margin-left: 70%;
        margin-top: 2%;
    }

    #sidebar {
        display: none;
    }

    #mobile-filter {
        padding: 10px;
    }
}
</style>
