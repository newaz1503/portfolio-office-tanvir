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
                    <Input title="Name" field="name" type="text" :req="true" />
                    <!------------ Single Input ------------>
                    <Input
                        v-if="!$route.params.id"
                        title="Email"
                        field="email"
                        type="email"
                        :req="true"
                    />
                    <!------------ Single Input ------------>
                    <Input
                        v-if="!$route.params.id"
                        title="Password"
                        field="password"
                        type="password"
                        :req="true"
                    />
                    <!------------ Single Input ------------>
                    <Select
                        title="Select Role"
                        field="role_id"
                        :req="true"
                        :datas="extraData.roles"
                    />
                    <!------------ Single Input ------------>
                    <Input title="Mobile" field="mobile" type="number" :req="false" />
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
const model = "admin";

export default {
  data() {
    return {
      model: model,
      data: {
        role_id: "",
        status: "active",
      },
      extraData: {
        roles: [],
      },
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
  },
  created() {
    if (this.$route.params.id) {
      this.setBreadcrumbs(this.model, "edit");
      this.get_data(this.model, this.$route.params.id, "data");
    } else {
      this.setBreadcrumbs(this.model, "create");
    }
    this.get_paginate_data("role", { allData: true }, "roles"); // get roles
  },
  // ================== validation rule for form ==================
  validators: {
    "data.name": function (value = null) {
      return Validator.value(value).required("Name is required");
    },
    "data.email": function (value = null) {
      if (!this.$route.params.id) {
        return Validator.value(value).required("Email is required").email();
      }
    },
    "data.role_id": function (value = null) {
      return Validator.value(value).required("Role is required");
    },
    "data.password": function (value = null) {
      if (!this.$route.params.id) {
        return Validator.value(value)
          .required("Password is required")
          .minLength(6);
      }
    },
    "data.mobile": function (value = null) {
      return Validator.value(value)
        .digit()
        .regex("01+[0-9+-]*$", "Must start with 01.")
        .minLength(11)
        .maxLength(11);
    },
  },
};
</script>
