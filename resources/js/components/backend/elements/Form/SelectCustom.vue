<template>
  <div class="form-group" :class="getClass()">
    <label :class="req ? 'control-label' : ''">{{ title }}</label>
    <select
      v-model="$parent.data[field]"
      :name="field"
      :disabled="disable ? true : false"
      :readonly="readOnly ? true : false"
      class="form-select form-select-sm"
    >
      <option value>--Select One---</option>
      <option
        v-for="(value, index) in datas"
        :key="index"
        v-bind:value="value[val]"
      >
        {{ value[val_title] }}
      </option>
    </select>
    <span class="help-block">{{
      $parent.validation.firstError("data." + field)
    }}</span>
  </div>
</template>

<script>
export default {
  props: [
    "title",
    "field",
    "col",
    "req",
    "datas",
    "val",
    "val_title",
    "disable",
    "readOnly",
  ],

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
  },
};
</script>
