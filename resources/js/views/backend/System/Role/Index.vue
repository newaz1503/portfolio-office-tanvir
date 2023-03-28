<template>
    <div class="card">
        <div class="card-body">
            <div class="row mb-3 justify-content-end">
                <div class="col-lg-8">
                    <form v-on:submit.prevent="search">
                        <!--============ Search Option Start ============-->
                        <Search :fields_name="fields_name"/>
                        <!--============ Search Option End ============-->
                    </form>
                </div>
                <div class="col-lg-4 text-end">
                    <a
                        @click="systemRoleUpdate"
                        class="btn btn-xs mr-2 btn-primary pull-left text-white"
                        title="Add New"
                    >
                        <i class="fa fa-refresh"></i>
                        <span class="text-capitalize">System Role Update </span>
                    </a>
                    <router-link
                        v-if="$root.checkPermission('role.create')"
                        :to="{ name: 'role.create' }"
                        class="btn btn-xs btn-success pull-left text-white"
                        title="System Role Update "
                    >
                        <i class="fa fa-plus"></i>
                        <span class="text-capitalize">Add Role</span>
                    </router-link>
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
const model = "role";

// define table coloumn show in datatable / datalist
const tableColumns = [
  { field: "name", title: "Role Name" },
  { field: "status", title: "Status", align:"center"},
  { field: "created_at", title: "Created at",date:true },
];
//json fields for export excel
const json_fields = {
  "Role Name": "name",
  "Created at": "created_at",
};

export default {
  data() {
    return {
      model: model,
      json_fields: json_fields,
      fields_name: { 0: "Select One", name: "Name" },
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
      this.get_paginate_data(this.model, this.search_data);
    },
    systemRoleUpdate() {
      axios.get("/systems-update").then((res) => {
        this.notification(res.data.message, "success");
      });
    },
  },
  async created() {
    await this.search(); // get data list
    this.getRouteName(this.model); // get route name for edit / delete / show
    this.setBreadcrumbs(this.model, "index"); // Set Breadcrumbs
  },
};
</script>
