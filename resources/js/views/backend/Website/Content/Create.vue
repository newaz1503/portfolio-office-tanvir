<template>
  <div>
    <div class="box box-success" v-if="!$root.spinner">
      <div class="box-header with-border">
        <h3 class="box-title">{{ model + " Create" }}</h3>

        <!--============ Add or Back Button Start ============-->
        <div class="box-tools pull-right">
          <router-link
            :to="{
              name: model + '.show',
              params: { slug: $route.params.slug },
            }"
            class="btn btn-xs btn-success pull-left text-white mr-2"
            title="View File"
          >
            <i class="fa fa-eye"></i>
            <span class="text-capitalize">View {{ model }}</span>
          </router-link>
          <router-link
            :to="{ name: model + '.file' }"
            class="btn btn-xs btn-success pull-left text-white"
            title="Add File"
          >
            <i class="fa fa-plus"></i>
            <span class="text-capitalize">Add {{ model }} File</span>
          </router-link>
        </div>
        <!--============ Add or Back Button End ============-->
      </div>

      <div class="box-body box-min-height">
        <!--============ Form Start ============-->
        <div class="row">
          <form
            v-on:submit.prevent="submit"
            enctype="multipart/form-data"
            id="form"
            class="form-row col-12"
          >
            <!------------ Single Input ------------>
            <Input
              title="Title"
              field="title"
              type="text"
              :req="true"
              col="6"
            />
            <!------------ Single Input ------------>
            <File
              title="Image"
              field="image"
              mime="img"
              :req="false"
              fileClassName="file1"
            />
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
            <div class="form-row col-12">
              <label class="col-12">Description</label>
              <div class="col-12">
                <editor :editorModel="'description'" />
              </div>
            </div>
            <!------------ Single Input ------------>
            <Meta />

            <!-------------- button -------------->
            <div class="col-12 mb-3 mt-4">
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
// define model name
const model = "content";

export default {
  data() {
    return {
      model: model,
      data: { status: "active", is_meta: 0, image: "" },
      image: {},
      errors: {},
    };
  },
  methods: {
    asyncData() {
      this.get_data(this.model, this.$route.params.slug, "data");
    },
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
          this.$root.submit = true;
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
          formData.append("slug", this.$route.params.slug);
          axios
            .post("/content", formData)
            .then((res) => {
              if (res.data.message) {
                this.notification(res.data.message, "success");
                this.$router.push({
                  name: "content.show",
                  params: { slug: this.$route.params.slug },
                });
              } else if (res.data.error) {
                this.notification(res.data.error, "error");
                setTimeout(() => {
                  location.reload();
                }, 100);
              } else if (res.data.warning) {
                this.notification(res.data.warning, "warning");
                this.$router.push({
                  name: "content.show",
                  params: { slug: this.$route.params.slug },
                });
              }
            })
            .catch((error) => console.log(error))
            .then((alw) => setTimeout(() => (this.$root.submit = false), 200));
        }
      });
    },
  },
  created() {
    // set breadcrumb
    var breadcrumb = [
      {
        route: model + ".create",
        title: model + " Create",
        slug: this.$route.params.slug,
      },
    ];
    breadcrumbs.dispatch("setBreadcrumbs", breadcrumb);
  },
  watch: {
    $route: {
      handler: "asyncData",
      immediate: true,
    },
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