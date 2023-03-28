<template>
  <div>
    <div class="box box-success" v-if="!$root.spinner">
      <div class="box-header with-border">
        <div class="row">
          <form v-on:submit.prevent="search" class="row col-12 ml-0">
            <div class="col-1 pl-3 no-padding">
              <datepicker
                v-model="search_data.from_date"
                format="d MMM yyyy"
                placeholder="From Date"
                class="form-control form-control-sm"
                name="from_date"
              ></datepicker>
            </div>
            <div class="col-1 pl-3 no-padding">
              <datepicker
                v-model="search_data.to_date"
                format="d MMM yyyy"
                placeholder="To Date"
                class="form-control form-control-sm"
                name="to_date"
              ></datepicker>
            </div>
            <div class="col-2 no-padding">
              <select
                @change="search()"
                v-model="search_data.description"
                class="form-control form-control-sm"
              >
                <option value>All User</option>
                <option
                  v-for="(admins, index) in extraData.admins"
                  :key="index"
                  v-bind:value="admins.name"
                >
                  {{ admins.name }}
                </option>
              </select>
            </div>

            <div class="col-1 pl-1 no-padding">
              <select
                @change="search()"
                v-model="search_data.action"
                class="form-control form-control-sm"
              >
                <option value>All</option>
                <option>Created</option>
                <option>Updated</option>
                <option>Deleted</option>
              </select>
            </div>
            <div class="col-1 pl-1 no-padding">
              <select
                @change="search()"
                v-model="search_data.status"
                class="form-control form-control-sm"
              >
                <option value>All</option>
                <option value="r">Read</option>
                <option value="ur">Unread</option>
              </select>
            </div>

            <!--============ Search Option Start ============-->
            <Search :fields_name="fields_name" />
            <!--============ Search Option End ============-->
            <div class="col-2 no-padding">
              <button
                type="button"
                @click="allRead"
                class="btn btn-sm btn-info text-white pull-right"
              >
                <i class="fa fa-newspaper-o"></i> Mark all as read
              </button>
            </div>
          </form>
        </div>
      </div>

      <!--============ Data List Start ============-->
      <div class="box-body box-min-height">
        <base-table
          :data="table.datas"
          :columns="table.columns"
          :routes="table.routes"
        ></base-table>
      </div>
      <!--============ Data List End ============-->

      <div class="box-footer clearfix">
        <!--============ Pagination Start ============-->
        <Pagination
          :url="model"
          v-if="!$root.spinner"
          :search_data="search_data"
        />
        <!--============ Pagination End ============-->
      </div>
    </div>
  </div>
</template>

<script>
// define model name
const model = "activityLog";

// define table coloumn show in datatable / datalist
const tableColumns = [
  { field: "log_name", title: "Module" },
  { field: "description", title: "Description" },
  { field: "status", title: "Status", align: "center" },
  { field: "created_at", title: "Created at", date: true },
];
//json fields for export excel
const json_fields = {
  Module: "log_name",
  Description: "description",
  Status: "status",
  "Created at": "created_at",
};

export default {
  data() {
    return {
      model: model,
      json_fields: json_fields,
      fields_name: {
        0: "Select One",
        log_name: "Module",
        description: "Description",
      },
      search_data: {
        pagination: 10,
        field_name: 0,
        value: "",
        description: "",
        action: "",
        status: "ur",
        date: "",
      },
      extraData: {
        admins: [],
      },
      table: {
        columns: tableColumns,
        routes: {
          view: model + ".show",
          destroy: model + ".destroy",
        },
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
    allRead() {
      this.$root.spinner = true;
      axios
        .get("/allRead")
        .then((res) => {
          this.search();
          this.notification(res.data.message, "success");
        })
        .catch((error) => console.log())
        .then((alw) => setTimeout(() => (this.$root.spinner = false), 200));
    },
  },
  async created() {
    await this.get_paginate_data(this.model, this.search_data);
    this.get_paginate_data("admin", { allData: true }, "admins"); // get admins+
    this.setBreadcrumbs(this.model, "index", "Activity Log");
  },
};
</script>