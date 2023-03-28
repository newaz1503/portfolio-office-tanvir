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
                <form
                    v-on:submit.prevent="submit"
                    enctype="multipart/form-data"
                    id="form"
                    class="row"
                >
                    <!------------ Single Input ------------>
                    <Input title="Title" field="title" :req="true"/>
                    <!------------ Single Input ------------>
                    <!-- <Input title="Icon" field="icon" /> -->
                      <!------------ Single Input ------------>
                      <Input title="Price" field="price" :req="true"/>
                      <!------------ Single Input ------------>
                    <!-- <Input
                        title="Sorting"
                        field="sorting"
                        type="text"
                        :req="true"
                        col="2"
                    /> -->
                       <!-- <Input title="Sub Title" field="sub_title" :req="true"/> -->
                    <Textarea title="Description" field="sub_title" :req="true" col="8"  />

                    <!------------ Single Select (using pluck) ------------>


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
                        <Button title="Submit" process=""/>
                    </div>
                    <!-------------- button -------------->
                </form>
            </div>
        </div>
    </div>
</template>

<script>
// define model name
const model = "serviceDetails";

export default {
  data() {
    return {
      model: model,
      data: {status: 'active'},
    };
  },
  methods: {
    submit: function () {
      this.$validate().then((res) => {
        const error = this.validation.countErrors();
        // If there is an error
        if (error > 0) {
          console.log(this.validation.allErrors());
          console.log(this.validation.allErrors());
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
  },

  // ================== validation rule for form ==================
  validators: {
    "data.title": function (value = null) {
      return Validator.value(value).required("Title is required");
    },
    "data.sub_title": function (value = null) {
      return Validator.value(value).required("Sub Title is required");
    },
    "data.price": function (value = null) {
      return Validator.value(value).required("Price is required");
    },
    "data.status": function (value = null) {
      return Validator.value(value).required("Status is required");
    },
  },
};
</script>
