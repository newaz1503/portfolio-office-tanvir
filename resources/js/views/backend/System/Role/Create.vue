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
            <div class="form" v-if="!$root.spinner">
                <form v-on:submit.prevent="submit" class="row">
                    <!------------ Single Input ------------>
                    <Input title="Name" field="name" type="text" :req="true" />
                    <!------------ Single Input ------------>
                    <Radio
                        title="Status"
                        field="status"
                        statusTitle1="Active"
                        statusTitle2="Deactive"
                        value1="active"
                        value2="deactive"
                        :req="true"
                        col="3"
                    />

                    <div class="w-100 my-2"></div>
                    <fieldset class="border border-primary w-100 p-2 m-2 rounded">
                        <legend
                            class="w-25 pl-1 font-weight-bold"
                            style="font-size: 1.2rem"
                        >
                            Permission Setting
                            <span class="float-right pr-2">
                            <input id="all" type="checkbox" value="1" v-model="checkAll" />
                            <label for="all">All</label>
                          </span>
                        </legend>

                        <table
                            v-if="extraData.permissions"
                            border="1"
                            class="table border table-hover"
                        >
                            <tr v-for="(perm, index) in extraData.permissions" :key="index">
                                <td class="controller" style="vertical-align: middle">
                                    <b>{{ perm.name.replace("Controller", "") }}</b>
                                </td>
                                <td class="action-wraper">
                                    <div class="row">
                                        <div
                                            v-for="(process, index2) in perm.children"
                                            :key="index2"
                                            class="col-3 actions"
                                        >
                                            <label class="text-capitalize">
                                                <input
                                                    type="checkbox"
                                                    :value="process.id"
                                                    v-model="data.permissions"
                                                />
                                                {{ process.name }}
                                            </label>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </fieldset>

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
const model = "role";

export default {
  data() {
    return {
      model: model,
      checkAll: null,
      data: { status: "active", permissions: [] },
      extraData: {
        permissions: [],
      },
      errors: {},
    };
  },
  watch: {
    checkAll: function (val, oldval) {
      this.data.permissions = [];
      if (val) {
        this.extraData.permissions.forEach((permission) => {
          permission.children.forEach((process) => {
            this.data.permissions.push(process.id);
          });
        });
      }
    },
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
          setTimeout(() => location.reload(), 400);
        }
      });
    },
  },
  created() {
    if (this.$route.params.id) {
      this.setBreadcrumbs(this.model, "edit"); // Set Breadcrumbs
      this.get_data(this.model, this.$route.params.id, "data"); // get data for edit
    } else {
      this.setBreadcrumbs(this.model, "create"); // Set Breadcrumbs
    }
    this.get_paginate_data("get-permissions", { allData: true }, "permissions");
  },

  // ================== validation rule for form ==================
  validators: {
    "data.name": function (value = null) {
      return Validator.value(value).required("Name is required");
    },
  },
};
</script>
