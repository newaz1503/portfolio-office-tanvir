<template>
  <div class="card">
          <div class="card-body">
              <div class="row mb-3  justify-content-end">
                  <div class="col-lg-8">
                      <form v-on:submit.prevent="search">
                          <!--============ Search Option Start ============-->
                          <Search :fields_name="fields_name" />
                          <!--============ Search Option End ============-->
                      </form>
                  </div>
                  <div class="col-lg-2 text-end order-last offset-2">
                      <!--============ Add or Back Button Start ============-->
                      <!-- <AddOrBackButton
                          :route="model + '.create'"
                          :portion="model"
                          :icon="'plus'"
                      /> -->
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
const model = "inquiry";

// define table coloumn show in datatable / datalist
const tableColumns = [
  { field: "name", title: "Name" },
  { field: "contact_method", title: "Contact Method" },
  { field: "photoshoot_type", title: "Photoshoot Type" },
  { field: "location", title: "Location"},
  { field: "created_at", title: "Created at",date:true }
];
//json fields for export excel
const json_fields = {
  Title: "title",
  "Created at": "created_at"
};

export default {
  data() {
    return {
      model: model,
      json_fields: json_fields,
      fields_name: { 0: "Select One", title: "Title" },
      search_data: {
        pagination: 10,
        field_name: 0,
        value: ""
      },
      table: {
        columns: tableColumns,
        routes: {},
        datas: [],
        meta: [],
        links: []
      }
    };
  },
  methods: {
    destroy(id) {
      this.destroy_data(this.model, id, this.search_data);
    },
    search() {
      this.$route.query.page = "";
      this.get_paginate_data(this.model, this.search_data);
    }
  },
  async created() {
    await this.get_paginate_data(this.model, this.search_data);
    this.getRouteName(this.model);
    this.setBreadcrumbs(this.model, "index");
  }
};
</script>
