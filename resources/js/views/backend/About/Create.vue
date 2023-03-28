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
                    <Input title="Title" field="title" />
                    <Input title="Name" field="name" />
                    <File
                        title="Image"
                        field="image"
                        mime="img"
                        fileClassName="file1"
                        col="3"
                    />
                    <!------------ Single Input ------------>
                    <Input title="Email" field="email" />
                    <Input title="Phone" field="phone" />
                    <Input title="Age" field="age" />
                    <Input title="Birthday" type="date" field="birthday" />
                    <Input title="Website" field="website" />
                    <Input title="Degree" field="degree" />
                    <Input title="City" field="city" />
                    <Input title="Freelance" field="freelance" />
                    <Textarea title="Short Description" field="short_description" :req="false" col="6" />
                    <Textarea title="Long Description" field="long_description" :req="false" col="6" />


                    <!------------ Single Select (using pluck) ------------>
                    <!-- <Select
                        v-if="$root.permissions"
                        title="Select Title"
                        field="field_id"
                        :req="false"
                        :datas="$root.permissions"
                    /> -->
                    <!------------ Single Custom Select ------------>
                    <!-- <SelectCustom
                        v-if="$root.menus"
                        title="Select Title"
                        field="field_id"
                        :req="false"
                        :datas="$root.menus"
                        val="id"
                        val_title="menu_name"
                    /> -->
                    <!------------ Single Input ------------>
                    <!-- <Input
                        title="Sorting"
                        field="sorting"
                        type="text"
                        :req="true"
                        col="2"
                    /> -->
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
                    <!------------ Single Input ------------>
                    <!-- <div class="form-group col-12">
                        <label class="col-12 p-0">Description</label>
                        <div class="col-12 p-0">
                            <editor :editorModel="'description'"/>
                        </div>
                    </div> -->

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
const model = "about";

export default {
  data() {
    return {
      model: model,
      image: { image: "" },
      data: { image: "", sorting: "", status: 'active' },
    };
  },
  methods: {
    submit: function () {
      this.$validate().then((res) => {
        const error = this.validation.countErrors();
        // If there is an error
        if (error > 0) {
          console.log(this.validation.allErrors());
          this.notification(
            "You need to fill " + error + " more empty mandatory fields",
            "warning"
          );
          return false;
        }

        // If there is no error
        if (res) {
            let form = document.getElementById("form");
            let formData  = new FormData(form);
          if (this.data.id) {
            this.update(this.model, formData, this.data.id, "image",'about.create');
          } else {
            this.store(this.model, formData,'about.create');
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
    axios.get(this.model).then(res => {
                this.data = res.data;
            })
  },

  // ================== validation rule for form ==================
  validators: {
    "data.title": function (value = null) {
      return Validator.value(value).required("Title is required");
    },
    "data.status": function (value = null) {
      return Validator.value(value).required("Status is required");
    },
  },
};
</script>
