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
                    <File
                        title="Image"
                        field="image"
                        mime="img"
                        :req="true"
                        fileClassName="file1"
                        :crop="false"
                        col="3"
                    />
                    <!------------ Single Input ------------>
                    <SelectCustom
                        v-if="categories"
                        title="Select Category"
                        field="category_id"
                        :req="true"
                        :datas="categories"
                        val="id"
                        val_title="name"
                    />
                    <SelectCustom
                        v-if="portfoliotypes"
                        title="Select Portfolio Type"
                        field="typeportfolio_id"
                        :req="true"
                        :datas="portfoliotypes"
                        val="id"
                        val_title="name"
                    />
                    <Input title="Title" field="title" :req="true"/>
                    <!------------ Single Input ------------>
                    <Input title="Price" field="price" :req="true"/>
                    <Textarea title="Description" field="description" :req="false" col="6" />


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
const model = "portfolio";

export default {
  data() {
    return {
      model: model,
      image: { image: "" },
      data: { image: "", sorting: "", status: 'active' },
      categories:[],
      portfoliotypes: []
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
            let form = document.getElementById("form");
            let formData  = new FormData(form);
          if (this.data.id) {
            this.update(this.model, formData, this.data.id, "image");
          } else {
            this.store(this.model, formData);
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
    axios.get('/categories').then(res => {
        this.categories = res.data;
    })
    axios.get('/portfolio-types').then(res => {
        this.portfoliotypes = res.data;
    })

  },

  // ================== validation rule for form ==================
  validators: {
    "data.category_id": function (value = null) {
      return Validator.value(value).required("Category is required");
    },
    "data.typeportfolio_id ": function (value = null) {
      return Validator.value(value).required("Portfolio Type is required");
    },
    "data.title": function (value = null) {
      return Validator.value(value).required("Title is required");
    },
    "data.image": function (value = null) {
      return Validator.value(value).required("Image is required");
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
