<template>
  <div class="form-row col-12 mt-3">
    <label class="col-12">
      <b-form-checkbox
        class="col-form-label-sm col-6"
        v-model="$parent.data.is_meta"
        name="is_meta"
        :value="1"
        :unchecked-value="0"
      >
        Meta
      </b-form-checkbox>
    </label>
    <div class="col-12" v-if="$parent.data.is_meta">
        <div class="form-group col-6">
            <label for="">Meta Keywords</label>
            <input
                type="text"
                name="meta_key"
                v-model="$parent.data.meta_keyword"
                class="form-control"
            >
        </div>
        <div class="form-group col-12">
            <label for="">Meta Description</label>
            <textarea
                name="meta_description"
                v-model="$parent.data.meta_description"
                class="form-control"
            ></textarea>
        </div>
    </div>
  </div>
</template>
