<template>
  <div>
    <div class="box box-success" v-if="!$root.spinner">
      <div class="box-header with-border">
        <div class="row">
          <div class="col-2 pl-3 no-padding">
            <select class="form-control form-control-sm">
              <option>option 1</option>
            </select>
          </div>
          <div class="col-2 no-padding">
            <input
              type="text"
              name="table_search"
              class="form-control form-control-sm"
              placeholder="Search"
            />
          </div>
          <div class="col-1 no-padding">
            <a href="javascript:void(0)" class="btn btn-sm btn-success">
              <i class="fa fa-search"></i>
            </a>
          </div>
        </div>

        <div class="box-tools pull-right">
          <router-link
            :to="{ name: 'document.create' }"
            class="btn btn-xs btn-success pull-left text-white"
          >
            <i class="fa fa-plus"></i> Add New
          </router-link>
          <!-- <a href="javascript:void(0)" class="btn btn-xs pull-left" data-widget="collapse">
            <i class="fa fa-minus"></i>
          </a>
          <a href="javascript:void(0)" class="btn btn-xs pull-left" data-widget="remove">
            <i class="fa fa-times"></i>
          </a>-->
        </div>
      </div>

      <hr />

      <!-- GLOBAL BASE TABLE -->
      <!-- GLOBAL BASE TABLE -->
      <!-- GLOBAL BASE TABLE -->
      <div class="box-header with-border">
        <div class="row">
          <form
            v-on:submit.prevent="search"
            class="form-row col-12 no-padding pl-1"
          >
            <!--============ Search Option Start ============-->
            <Search :fields_name="fields_name" />
            <!--============ Search Option End ============-->
          </form>
        </div>

        <!--============ Add or Back Button Start ============-->
        <AddOrBackButton
          :route="model + '.create'"
          :portion="model"
          :icon="'plus'"
        />
        <!--============ Add or Back Button End ============-->
      </div>

      <!-- /.box-header -->
      <div class="box-body">
        <base-table
          :data="table.datas"
          :columns="table.columns"
          :routes="table.routes"
        ></base-table>
      </div>
      <!-- /.box-body -->

      <div class="box-footer clearfix">
        <!-- pagination -->
        <Pagination :url="'/user/'" v-if="!$root.spinner" />
        <!-- /pagination -->
      </div>
      <!-- /.box-footer -->
    </div>
  </div>
</template>

<script>
// define model name
const model = "user";

const breadcrumb = [{ route: "document.index", title: "Document List" }];

// routes name
const routes = {
  view: model + ".show",
  edit: model + ".edit",
  destroy: model + ".destroy",
  array: [
    {
      route: model + ".passGenerate",
      icon: "users",
      btnColor: "info",
    },
    {
      route: model + ".quotationList",
      icon: "users",
      btnColor: "success",
    },
  ],
};

// extra button added in top
const extraButtons = [
  {
    route: model + ".passGenerate",
    icon: "lock",
    btnColor: "info",
    name: "info",
  },
  {
    route: model + ".quotationList",
    icon: "list",
    btnColor: "success",
    name: "info",
  },
];

// define table coloumn show in datatable / datalist
const tableColumns = [
  { field: "name", title: "Name" },
  { field: "email", title: "Email" },
  {
    field: "image",
    title: "Image",
    image: true,
    width: "50",
    height: "50",
  },
  { field: "album", title: "Album Name", subfield: "name", align: "center" },
  {
    field: "status",
    title: "Status",
    array: true,
    array_value: [
      { active: "Full Active", deactive: "Deactive", p: "Pending" },
    ],
  },
  { field: "created_at", title: "Created at", date: true },
  {
    field: "sorting",
    title: "Sorting",
    sorting: true,
    namespace: "System-Menu",
    auto: "", // auto true / ""
    align: "center",
  },
];

//json fields for export excel
const json_fields = {
  Name: "name",
  Name: "album.name", // sub filed album, colunm = name
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
      data: {},
      errors: {},
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
    getDatas: function (page_index) {
      let url = "/user";
      if (page_index > 0) {
        url = "/user/?page=" + page_index;
      }
      axios
        .get(url, { params: this.search_data })
        .then((respons) => {
          this.table.datas = respons.data.data;
          this.table.meta = respons.data.meta;
          this.table.links = respons.data.links;
        })
        .catch((error) => console.log(error))
        .then((alw) => setTimeout(() => (this.$root.spinner = false), 200));
    },
    submit: function () {
      this.$root.spinner = true;
      if (this.data.id) {
        axios
          .put("/user" + this.data.id, this.data)
          .then((respons) => {
            // this.$router.push("/country");
          })
          .catch((error) => {
            if (error.response.status === 422) {
              this.errors = error.response.data.errors || {};
            }
          })
          .then((alw) => setTimeout(() => (this.$root.spinner = false), 200));
      } else {
        axios
          .post("/user", this.data)
          .then((respons) => {
            // this.$router.push("/country");
          })
          .catch((error) => {
            if (error.response.status === 422) {
              this.errors = error.response.data.errors || {};
            }
          })
          .then((alw) => setTimeout(() => (this.$root.spinner = false), 200));
      }
    },
    get_data: function (id) {
      axios
        .get("/user" + id)
        .then((respons) => {
          this.data = respons.data;
        })
        .catch((error) => console.log(error))
        .then((alw) => setTimeout(() => (this.$root.spinner = false), 200));
    },
  },
  mounted() {},
  created() {
    this.getDatas();
    if (this.$route.params.id) {
      this.get_data(this.$route.params.id);
    }

    breadcrumbs.dispatch("setBreadcrumbs", breadcrumb);
    setTimeout(() => (this.$root.spinner = false), 200);
  },
  async created() {
    await this.get_paginate_data(this.model, this.search_data); // get data list
    this.getRouteName(this.model); // get route name for edit / delete / show
    this.setBreadcrumbs(this.model, "index"); // Set Breadcrumbs
    // this.get_paginate_data("admin", { allData: true }, "admins"); // get admins
  },
  beforeCreate() {
    this.$root.spinner = true;
  },
};
</script>

<style>
</style>
