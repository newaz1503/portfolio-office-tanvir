<template>
    <div v-if="!$root.spinner">
        <div class="row">
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <h5 class="text-muted fw-normal mt-0 text-truncate" title="Campaign Sent">Total User</h5>
                                <h3 class="my-2 py-1">{{ statistics.total_user }}</h3>

                            </div>
                            <div class="col-6">
                                <div class="text-end">
                                    <div id="campaign-sent-chart" data-colors="#727cf5"></div>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div> <!-- end col -->

            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <h5 class="text-muted fw-normal mt-0 text-truncate" title="New Leads">Total Category</h5>
                                <h3 class="my-2 py-1">{{statistics.total_category  }}</h3>
                                <p class="mb-0 text-muted">

                                </p>
                            </div>
                            <div class="col-6">
                                <div class="text-end">
                                    <div id="new-leads-chart" data-colors="#0acf97"></div>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div> <!-- end col -->

            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <h5 class="text-muted fw-normal mt-0 text-truncate" title="Deals">Today's Order</h5>
                                <h3 class="my-2 py-1">{{statistics.today_order }}</h3>
                                <p class="mb-0 text-muted">

                                </p>
                            </div>
                            <div class="col-6">
                                <div class="text-end">
                                    <div id="deals-chart" data-colors="#727cf5"></div>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div> <!-- end col -->

            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <h5 class="text-muted fw-normal mt-0 text-truncate" title="Booked Revenue">Total Order</h5>
                                <h3 class="my-2 py-1">{{statistics.total_order  }}</h3>
                                <p class="mb-0 text-muted">

                                </p>
                            </div>
                            <div class="col-6">
                                <div class="text-end">

                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div> <!-- end col -->
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="header-title">Todays Order</h4>
                    </div>

                    <div class="card-body pt-0">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                <th scope="col">SI</th>
                                <th scope="col">User Name</th>
                                <th scope="col">Image</th>
                                <th scope="col">Price</th>
                                <th scope="col">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in statistics.today_orders" :key="index">
                                    <td>{{ index + 1}}</td>
                                    <td>{{ item.user.name }}</td>

                                    <td>
                                        <img height="40px" width="40px" :src="item.portfolio.image" alt="image">
                                    </td>
                                    <td>{{ item.portfolio.price }}</td>
                                    <td>{{ item.created_at }}</td>
                                </tr>

                            </tbody>
                        </table>


                    </div>
                    <!-- end card body-->
                </div>
                <!-- end card -->
            </div>
            <!-- end col-->


            <!-- end col-->
        </div>
        <!-- end row-->
    </div>
</template>

<script>
const breadcrumb = [{ route: "admin.dashboard", title: "Dashboard" }];
export default {
    data() {
        return {
            menus: [],
            statistics : []

        };
    },
    methods: {
        getMenus() {
            this.$root.$loader.$emit("loading", true);
            axios
                .get("/get-dashboard-menus")
                .then(res => (this.menus = res.data))
                .catch(error => console.log())
                .then(alw =>
                    setTimeout(
                        () => this.$root.$loader.$emit("loading", false),
                        500
                    )
                );
        },
        getStaticstic(){
            axios
                .get("/get-statistics")
                .then(res => (this.statistics = res.data))
                .catch(error => console.log())
                .then(alw =>
                    setTimeout(
                        () => this.$root.$loader.$emit("loading", false),
                        500
                    )
                );
        },
    },
    created() {
        this.getMenus();
        this.getStaticstic();
        breadcrumbs.dispatch("setBreadcrumbs", breadcrumb);
    }
};
</script>
<style>
.btn .badge {
    position: absolute;
}

.btn.btn-app {
    width: 105px;
    font-size: 12px;
    white-space: inherit;
    height: 90px;
}
</style>
