<template>
    <div class="card">
        <div class="card-body">
            <div class="row mb-3 justify-content-end">
                <div class="col-lg-2 text-end order-last offset-2">
                    <!--============ Add or Back Button Start ============-->
                    <AddOrBackButton
                        :route="model + '.index'"
                        :portion="model"
                        :icon="'arrow-left'"
                    />
                </div>
            </div>
            <div class="form">
                <form v-on:submit.prevent="submit" class="row">
                    <!------------ Single Input ------------>
                    <Select
                        v-if="allMenus"
                        title="Parent Menu"
                        field="parent_id"
                        :req="false"
                        :datas="allMenus"
                    />
                    <!------------ Single Input ------------>
                    <Input
                        title="Menu Name"
                        field="menu_name"
                        type="text"
                        :req="true"
                    />
                    <!------------ Single Input ------------>
                    <Input title="Menu Icon" field="icon" type="text" :req="false" />
                    <!------------ Single Input ------------>
                    <Input
                        title="Sorting"
                        field="sorting"
                        type="text"
                        :req="true"
                        col="2"
                    />
                    <!------------ Single Input ------------>
                    <div
                        class="form-group col-3"
                        :class="{
                'has-error': validation.hasError('data.route_name'),
                'has-success': data.route_name,
              }"
                    >
                        <label>Route Name</label>
                        <select
                            v-model="data.route_name"
                            class="form-control form-control-sm"
                        >
                            <option value>Select parent menu</option>
                            <option
                                v-for="(value, id, index) in $root.permissions"
                                :key="index"
                                v-bind:value="value"
                            >
                                {{ value }}
                            </option>
                        </select>
                        <span class="help-block">{{
                validation.firstError("data.route_name")
              }}</span>
                    </div>

                    <!------------ Single Input ------------>
                    <Input title="Params" field="params" type="text" :req="false" />
                    <!------------ Single Input ------------>
                    <Radio
                        title="Show Dashboard"
                        field="show_dasboard"
                        statusTitle1="Yes"
                        statusTitle2="No"
                        value1="1"
                        value2="0"
                        :req="true"
                        col="2"
                    />
                    <!-------------- button -------------->
                    <div class="col-12 mb-3 mt-2">
                        <Button title="Submit" process="" />
                    </div>
                    <!-------------- button -------------->
                </form>
            </div>
        </div>
    </div>
</template>

<script>
// define model name
const model = "menu";

export default {
  data() {
    return {
      model: model,
      dominions: {},
      allMenus: [],
      data: {
        parent_id: "",
        route_name: "",
        sorting: 0,
        icon: "<i class='fa fa-circle-o text-aqua'></i>",
        show_dasboard: 0,
      },
      errors: {},
    };
  },
  methods: {
    submit: function () {
      const error = this.validation.countErrors();
      this.$validate().then((res) => {
        // If there is an error
        if (error > 0) {
          this.notification(
            "You need to fill " + error + " more empty mandatory fields",
            "warning"
          );
          return false;
        }

        // If there is no error
        if (res) {
          if (this.data.id) {
            this.update(this.model, this.data, this.data.id);
          } else {
            this.store(this.model, this.data);
          }
        }
      });
    },
    menus() {
      axios.get("/get-menus/menu").then((res) => (this.allMenus = res.data));
    },
  },
  created() {
    if (this.$route.params.id) {
      this.setBreadcrumbs(this.model, "edit", "Menu");
      this.get_data(this.model, this.$route.params.id, "data");
    } else {
      this.setBreadcrumbs(this.model, "create", "Menu");
      this.get_sorting("System-Menu");
    }
    this.menus();
  },

  // ================== validation rule for form ==================
  validators: {
    "data.menu_name": function (value = null) {
      return Validator.value(value).required("Name is required");
    },
    "data.sorting": function (value = null) {
      return Validator.value(value).digit().required("sorting is required");
    },
  },
};
</script>
