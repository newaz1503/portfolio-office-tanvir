<template>
  <div>
    <div class="box box-success" v-if="!$root.spinner">
      <div class="box-header with-border">
        <h3 class="box-title">{{ model + " Create" }}</h3>

        <!--============ Add or Back Button Start ============-->
        <AddOrBackButton
          :route="model + '.index'"
          :portion="model"
          :icon="'arrow-left'"
        />
        <!--============ Add or Back Button End ============-->
      </div>

      <div class="box-body box-min-height">
        <!--============ Form Start ============-->
        <div class="row">
          <form v-on:submit.prevent="submit" id="form" class="form-row col-12">
            <!------------ Custom Input ------------>
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
            <div
              class="form-group col-3"
              :class="{
                'has-error': validation.hasError('data.position'),
                'has-success': data.position,
              }"
            >
              <label class="control-label">Menu position</label>
              <select
                v-model="data.position"
                name="position"
                class="form-control form-control-sm"
              >
                <option value>Select menu position</option>
                <option value="header">Header</option>
                <option value="top_bar">Top Bar</option>
                <option value="footer_bottom">Footer Bottom</option>
              </select>
              <span class="help-block">{{
                validation.firstError("data.position")
              }}</span>
            </div>

            <!------------ Single Select (using pluck) ------------>
            <Select
              v-if="datas"
              title="Select Title"
              field="field_id"
              :req="false"
              :datas="datas"
            />
            <!------------ Single Custom Select ------------>
            <SelectCustom
              v-if="$root.menus"
              title="Select Title"
              field="field_id"
              :req="false"
              :datas="$root.menus"
              val="id"
              val_title="menu_name"
            />
            /
            <!------------ Single Input ------------>
            <div
              class="form-group col-3"
              :class="{
                'has-error': validation.hasError('data.form'),
                'has-success': data.form,
              }"
            >
              <label>Custom Form</label>
              <input
                type="text"
                v-model="data.form"
                class="form-control form-control-sm"
              />
              <span class="help-block">{{
                validation.firstError("data.form")
              }}</span>
            </div>
            <!------------ Single Input ------------>
            <Input title="Title" field="title" type="text" :req="false" />
            <Input
              title="Title"
              field="title"
              type="text"
              :req="false"
              col="6"
            />
            <!------------ Single Input ------------>
            <Input
              title="Sorting"
              field="sorting"
              type="text"
              :req="true"
              col="2"
            />
            <Textarea title="Map" field="map" :req="false" col="12" />
            <!------------ Single Input ------------>
            <Radio
              title="Status"
              field="status"
              statusTitle1="Active"
              statusTitle2="Deactive"
              value1="active"
              value2="deactive"
              :req="true"
              col="2"
            />
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

            <!-- if you use file, please add field_name in your form data object,
            and add this image:{} object after data object 
            then use onFileChange() function on your method-->
            <!------------ Single Input ------------>
            <File
              title="Logo"
              field="logo"
              mime="img"
              :req="true"
              fileClassName="file1"
            />

            <!------------ Single Input ------------>
            <Meta />

            <!------------ Single Input ------------>
            <div
              class="form-group col-3"
              :class="{
                'has-error': validation.hasError('data.date'),
                'has-success': data.date,
              }"
            >
              <label>Datepicker</label>
              <datepicker
                v-model="data.date"
                format="D dsu MMM yyyy"
                placeholder="Select Date"
                class="form-control form-control-sm"
                name="date"
              ></datepicker>
              <span class="help-block">
                {{ validation.firstError("data.date") }}
              </span>
            </div>
            <!------------ Single Input ------------>
            <div class="form-group col-12">
              <label class="col-12 p-0">Description</label>
              <div class="col-12 p-0">
                <editor :editorModel="'description'" />
              </div>
            </div>

            <!-------------- button -------------->
            <div class="col-12 mb-3 mt-5">
              <Button title="Submit" process="" />
            </div>
            <!-------------- button -------------->
          </form>
        </div>
        <!--============ Form End ============-->
      </div>
    </div>
  </div>
</template>

<script>
// ===============Promise===============
import Promise from "bluebird"; //when use validation custom
import Input from "../../../components/backend/elements/Form/Input.vue";
import Input from "../../../components/backend/elements/Form/Input.vue";
// define model name
const model = "doc";

// set breadcrumb
//const breadcrumb = [{ route: "module.create", title: "Module Create" }];

export default {
  components: { Input },
  data() {
    return {
      model: model,
      selectMenu: {
        1: "Nothing",
        2: "Something",
      },
      data: {
        select: "",
        profile: "",
        pdf_file: "",
      },
      image: {},
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
    submitWithImage: function () {
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
          var form = document.getElementById("form");
          var formData = new FormData(form);
          if (this.image.image) {
            formData.append("image", this.image.image);
          } else {
            formData.append("image", "");
          }
          if (this.data.description) {
            formData.append("description", this.data.description);
          } else {
            formData.append("description", "");
          }
          if (this.data.id) {
            this.update(this.model, formData, this.data.id, "image");
          } else {
            this.store(this.model, formData);
          }
        }
      });
    },
    onFileChange(e, model, fileClass, pdf = null) {
      this.showImage(e, model, model, fileClass, pdf); // 1st data image, second show image
    },
    axiosReq() {
      const error = this.validation.countErrors();
      this.$validate().then((res) => {
        if (res) {
          this.$root.spinner = true;
          axios
            .post("/module/create", this.data)
            .then((res) => {
              this.notification("Module Create Successfully", "success");
              this.$router.push({
                name: this.model + ".index",
                params: { model: this.data.model_name },
              });
            })
            .catch((error) =>
              this.notification(
                "Something went wrong, but Some file are crated, please check",
                "error"
              )
            )
            .then((alw) => setTimeout(() => (this.$root.spinner = false), 200));
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
      //breadcrumbs.dispatch("setBreadcrumbs", breadcrumb); // Set Breadcrumbs
      setTimeout(() => (this.$root.spinner = false), 200);
    }
  },
  beforeCreate() {
    this.$root.spinner = true;
  },

  // ================== validation rule for form ==================
  validators: {
    "data.name": function (value = null) {
      //return Validator.value(value).required("Name is required");
    },
  },
};
</script>