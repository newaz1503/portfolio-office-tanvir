<template>
  <div class="form-group" :class="'col-' + col">
    <label :class="req ? 'control-label' : ''">{{ title }}</label>

    <div class="row mt-2">
      <div class="col-6">
          <b-form-radio
              :value="value1"
              :name="field"
              v-model="$parent.data[field]"
            > {{ statusTitle1 }}
          </b-form-radio>
<!--        <input-->
<!--          type="radio"-->
<!--          :name="field"-->
<!--          v-model="$parent.data[field]"-->
<!--          :value="value1"-->
<!--        />-->
      </div>
      <div class="col-6">
          <b-form-radio
              :name="field"
              v-model="$parent.data[field]"
              :value="value2"
          > {{ statusTitle2 }}
          </b-form-radio>
<!--        <input-->
<!--          type="radio"-->
<!--          :name="field"-->
<!--          v-model="$parent.data[field]"-->
<!--          :value="value2"-->
<!--        />-->
<!--        {{ statusTitle2 }}-->
      </div>
    </div>

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
    "statusTitle1",
    "statusTitle2",
    "value1",
    "value2",
    "col",
    "req",
  ],
};
</script>
