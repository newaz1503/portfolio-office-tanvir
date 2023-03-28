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
                    <Select
                        v-if="albums"
                        title="Album"
                        field="album_id"
                        :req="true"
                        :datas="albums"
                    />
                    <!------------ Single Input ------------>
                    <Input
                        title="Title"
                        field="title"
                        type="text"
                        col="4"
                        :req="true"
                    />
                    <!------------ Single Input ------------>
                    <Input title="URL" field="url" type="url" :req="true" />
                    <!------------ Single Input ------------>
                    <Input
                        title="Sorting"
                        field="sorting"
                        type="text"
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
const model = "video";

export default {
  data() {
    return {
      model: model,
      data: { album_id: "" },
      albums: {},
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
    getAlbum() {
      axios.get("/get-album/Videos").then((res) => (this.albums = res.data));
    },
  },
  created() {
    if (this.$route.params.id) {
      this.setBreadcrumbs(this.model, "edit");
      this.get_data(this.model, this.$route.params.id, "data"); // get data for edit
    } else {
      this.setBreadcrumbs(this.model, "create");
      this.get_sorting("Website-Gallery-Video");
    }
    this.getAlbum();
  },

  // ================== validation rule for form ==================
  validators: {
    "data.title": function (value = null) {
      return Validator.value(value).required("Title is required");
    },
    "data.album_id": function (value = null) {
      return Validator.value(value).required("Album is required");
    },
    "data.sorting": function (value = null) {
      return Validator.value(value).required("Sorting is required");
    },
    "data.url": function (value = null) {
      return Validator.value(value).required("URL is required");
    },
  },
};
</script>
