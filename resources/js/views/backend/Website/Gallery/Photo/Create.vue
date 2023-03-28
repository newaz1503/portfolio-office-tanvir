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
                >
                    <div class="row">
                    <!------------ Single Input ------------>
                    <Select
                        v-if="albums"
                        title="Album"
                        field="album_id"
                        :req="true"
                        :datas="albums"
                    />
                    <!------------ Single Input ------------>
                    <!-- <Input
                      title="Title"
                      field="title"
                      type="text"
                      col="4"
                      :req="true"
                    /> -->
                    <!------------ Single Input ------------>
                    <!-- <File
                      title="Image"
                      field="image"
                      mime="img"
                      :req="true"
                      fileClassName="file1"
                    /> -->

                    <!------------ Single Input ------------>
                    <div
                        class="form-group col-3"
                        :class="{
                'has-error': validation.hasError('data.image'),
                'has-success': data.image,
              }"
                    >
                        <label class="control-label">
                            Image <small>(Select max 20 images)</small>
                        </label>
                        <b-form-file
                            accept="image/*"
                            id="file-small-file"
                            size="sm"
                            multiple
                            name="files[]"
                            v-on:change="previewImages()"
                            drop-placeholder="Drop file here"
                        ></b-form-file>
                    </div>
                    <!------------ Single Input ------------>

                    <div class="w-100"></div>

                    <template v-if="Object.keys(data.uploaded_images).length > 0">
                        <div
                            v-for="(img, key) in data.uploaded_images"
                            :key="key"
                            class="col-3"
                        >
                            <div
                                style="
                    box-shadow: 0px 5px 30px 0px rgba(0, 0, 0, 0.1);
                    border: 1px solid #ddd;
                  "
                                class="item-blcok mb-2 p-3"
                            >
                                <div class="img d-flex justify-content-between">
                                    <img :src="img.image" alt="" style="height: 50px" />
                                    <input
                                        v-model="img.sorting"
                                        style="width: 80px"
                                        type="number"
                                        class="
                        text-center
                        form-control form-control-sm
                        rounded-0
                        mt-2
                      "
                                        :name="`uploaded_images[${key}][sorting]`"
                                        placeholder="Sorting"
                                    />
                                    <i
                                        class="fa fa-times text-danger"
                                        style="cursor: pointer"
                                        @click="data.uploaded_images.splice(key, 1)"
                                    ></i>
                                </div>
                                <div class="text d-flex pt-2">
                                    <input
                                        v-model="img.title"
                                        type="text"
                                        class="form-control form-control-sm rounded-0"
                                        placeholder="Title"
                                        :name="`uploaded_images[${key}][title]`"
                                    />
                                </div>
                            </div>
                        </div>
                    </template>

                    <div
                        v-if="Object.keys(data.uploaded_images).length > 0"
                        class="col-12 mb-3 mt-2"
                    >
                        <Button title="Submit" process="" />
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
// define model name
const model = "photo";

export default {
  data() {
    return {
      model: model,
      loading: false,
      data: {
        album_id: "1",
        sorting: 0,
        uploaded_images: [],
      },
      image: { image: "" },
      albums: {},
      errors: {},
    };
  },
  methods: {
    submit() {
      this.$validate().then((res) => {
        const error = this.validation.countErrors();
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

          if (Object.keys(this.data.uploaded_images).length == 0) {
            this.notification("Please select image", "error");
            return false;
          }

          this.store(this.model, formData);
        }
      });
    },
    previewImages() {
      let vm = this;
      vm.data.uploaded_images = [];
      let files = $("input[type='file']")[0].files;

      if (files.length > 20) {
        vm.notification("You can select max 20 images", "error");
        return false;
      }

      $.each(files, function (i, file) {
        let obj = {
          image: URL.createObjectURL(file),
          title: "",
          sorting: vm.data.sorting + i + 1,
        };
        vm.data.uploaded_images.push(obj);
      });
    },
    getAlbum() {
      axios.get("/get-album/Photos").then((res) => (this.albums = res.data));
    },
  },
  created() {
    this.setBreadcrumbs(this.model, "create");
    this.getAlbum();
    this.get_sorting("Website-Gallery-Photo");
  },

  // ================== validation rule for form ==================
  validators: {
    "data.album_id": function (value = null) {
      return Validator.value(value).required("Album is required");
    },
  },
};
</script>
