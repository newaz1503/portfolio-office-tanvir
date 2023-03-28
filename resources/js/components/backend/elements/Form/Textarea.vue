<template>
  <div class="form-group" :class="getClass()">
    <label :class="req ? 'control-label' : ''">{{ title }}</label>
    <textarea
      :type="type"
      v-model="$parent.data[field]"
      :name="field"
      class="form-control form-control-sm"
      :placeholder="title"
    >
    </textarea>
    <span class="help-block">{{
      $parent.validation.firstError("data." + field)
    }}</span>
  </div>
</template>

<script>
export default {
  props: ["title", "field", "type", "col", "req"],

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