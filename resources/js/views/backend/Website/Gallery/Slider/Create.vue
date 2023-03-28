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
                <form v-on:submit.prevent="submit" enctype="multipart/form-data" id="form">
                    <div class="row">
                        <!------------ Single Input ------------>
                        <Input title="Title" field="title" type="text" :req="true" />

                        <!------------ Single Input ------------>
                        <File
                            title="Slider"
                            field="slider"
                            mime="img"
                            :req="true"
                            fileClassName="file1"
                            :crop="false"
                            col="3"
                        />
                        <!-- FOR CROP IMAGE -->
                        <!-- <Crop
                            field="slider"
                            :image="image.slider"
                            :aspectRatio="{ aspectRatio: 18 / 6 }"
                            :width="1900"
                            :height="950"
                        /> -->

                        <!------------ Single Input ------------>
                        <Input
                            title="Sorting"
                            field="sorting"
                            type="text"
                            :req="true"
                            col="2"
                        />
                        <!------------ Single Input ------------>
                        <Input title="URL" field="url" type="url" :req="false" col="4" />
                        <Textarea title="Description" field="description" :req="false" col="8" rows="9" />
                        <!------------ Single Input ------------>
                        <!-- <div class="form-row col-12">
                            <label class="col-12">Description</label>
                            <div class="col-12">
                                <editor :editorModel="'description'" />
                            </div>
                        </div> -->

                        <!-------------- button -------------->
                        <div class="col-12 mb-3 mt-3">
                            <Button title="Submit" process="" />
                        </div>
                        <!-------------- button -------------->
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
// define model name
const model = "slider";

export default {
  data() {
    return {
      model: model,
      image: { slider: "" },
      data: { slider: "", sorting: "" },
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
      this.get_sorting("Website-Gallery-Slider");
    }
  },

  // ================== validation rule for form ==================
  validators: {
    "data.title": function (value = null) {
      return Validator.value(value).required("Title is required");
    },
    "data.slider": function (value = null) {
      return Validator.value(value).required("Slider is required");
    },
    "data.sorting": function (value = null) {
      return Validator.value(value).required("Sorting is required");
    },
  },
};
</script>
