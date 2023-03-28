<template>
    <div class="card">
        <div class="card-body">
            <div class="row mb-3  justify-content-end">
                <div class="col-lg-8">
                    <form v-on:submit.prevent="search">
                        <!--============ Search Option Start ============-->
                        <Search :fields_name="fields_name"/>
                        <!--============ Search Option End ============-->
                    </form>
                </div>
                <div class="col-lg-2 text-end order-last offset-2">
                    <!--============ Add or Back Button Start ============-->
                    <AddOrBackButton
                        :route="model + '.create'"
                        :portion="model"
                        :icon="'plus'"
                    />
                    <!--============ Add or Back Button End ============-->
                </div>

            </div>
            <div class="data-table">
                <base-table
                    :data="table.datas"
                    :columns="table.columns"
                    :routes="table.routes"
                    thead-classes="bg-light text-secondary"
                ></base-table>
                <Pagination
                    :url="model"
                    v-if="!$root.spinner"
                    :search_data="search_data"
                />
            </div>
        </div>
    </div>
</template>

<script>
    // define model name
    const model = "invoice";

    // define table coloumn show in datatable / datalist
    const tableColumns = [
        {field: "id", title: "Order Id"},
        {field: "user", title: "User", subfield:'name'},
        {field: "portfolio", title: "Portfolio Title", subfield:'title'},
        {field: "portfolio", title: "Price", subfield:'price'},
        {field: "portfolio", title: "Photo", subfield:'image', image:true, height:'50px',width:'50px'},

    ];
    //json fields for export excel
    const json_fields = {
        Name: "name",
        "Created at": "created_at",
    };

    export default {
        data() {
            return {
                model: model,
                json_fields: json_fields,
                fields_name: {
                    0: "Select One",
                    invoice_number: "Invoice Number",
                },
                search_data: {
                    pagination: 10,
                    field_name: 0,
                    value: "",
                },
                table: {
                    columns: tableColumns,
                    routes: {},
                    datas: [],
                    meta: [],
                    links: [],
                },
            };
        },
        methods: {
            destroy(id) {
                this.destroy_data(this.model, id, this.search_data);
            },
            search() {
                this.$route.query.page = "";
                this.get_paginate_data(this.model, this.search_data);
            },
        },
        async created() {
            await this.get_paginate_data(this.model, this.search_data);
            this.getRouteName(this.model);
            this.setBreadcrumbs(this.model, "index", "Payment History");
        },
    };
</script>
