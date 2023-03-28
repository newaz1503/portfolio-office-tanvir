<template>
  <div class="form-group" :class="getClass()">
    <label :class="req ? 'control-label' : ''">{{ title }}</label>

    <div class="row">
      <div class="col-2">
        <img
          class="img-responsive choose-file-size"
          :src="
            $parent.image[field]
              ? $parent.image[field]
              : $parent.data[field]
              ? $parent.data[field]
              : $root.noimage
          "
          alt="picture"
        />
      </div>
      <div class="col-10">
        <b-form-file
          v-if="crop"
          :accept="mime == 'img' ? 'image/*' : '.pdf'"
          :id="'file-small file' + fileClassName"
          size="sm"
          :name="field"
          class="overflow-hidden"
          :class="fileClassName"
          v-on:change="showCropImage($event, field, fileClassName)"
          drop-placeholder="Drop file here"
        ></b-form-file>

        <b-form-file
          v-else
          :accept="mime == 'img' ? 'image/*' : '.pdf'"
          :id="'file-small file' + fileClassName"
          size="sm"
          :name="field"
          class="overflow-hidden"
          :class="fileClassName"
          v-on:change="onFileChange($event, field, fileClassName)"
          drop-placeholder="Drop file here"
        ></b-form-file>
      </div>
    </div>

    <span class="help-block">{{
      $parent.validation.firstError("data." + field)
    }}</span>
  </div>
</template>

<script>
export default {
  props: ["title", "field", "col", "req", "mime", "fileClassName", "crop"],

  methods: {
    getClass() {
      let col = this.col ? this.col : 3;
      let className = "col-" + col + " ";
      if (this.$parent.validation.hasError("data." + this.field)) {
        className += "has-error";
      } else if (this.$parent.data[this.field]) {
        className += "has-success";
      }
      return className;
    },
    onFileChange(e, model, fileClass) {
      let pdf = this.mime == "pdf" ? "pdf" : null;
      this.showImageGlobal(e, model, model, fileClass, pdf);
    },
  },
};
</script>
<style>
    img.choose-file-size {
        height: 35px;
        width: 35px;
        border-radius: 4px;
    }
</style>
