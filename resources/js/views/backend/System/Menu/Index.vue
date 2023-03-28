<template>
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-lg-8">
                    <form v-on:submit.prevent="search">
                        <!--============ Search Option Start ============-->
                        <Search :fields_name="fields_name" />
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
const model = "menu";

// define table coloumn show in datatable / datalist
const tableColumns = [
  { field: "parent", title: "Parent Menu", subfield: "menu_name" },
  { field: "menu_name", title: "Menu Name" },
  { field: "route_name", title: "Route Name", align: "center" },
  { field: "params", title: "Params", align: "center" },
  {
    field: "sorting",
    title: "Sorting",
    sorting: true,
    namespace: "System-Menu",
    auto: "",
    align: "center",
  },
];
//json fields for export excel
const json_fields = {
  "Menu Name": "name",
  "Parent Name": "parent.name",
  Sorting: "sorting",
};

export default {
  data() {
    return {
      model: model,
      json_fields: json_fields,
      fields_name: { 0: "Select One", menu_name: "Name" },
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
    this.getRouteName(this.model); // get route name for edit / delete / show
    this.setBreadcrumbs(this.model, "index", "Menu"); // Set Breadcrumbs
  },
};
</script>
