<template>
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-4">
                <select
                    v-model="$parent.search_data.field_name"
                    class="form-select form-select-sm"
                >
                    <option
                        v-for="(value, name, index) in fields_name"
                        :key="index"
                        v-bind:value="name"
                    >
                        {{ value }}
                    </option>
                </select>
            </div>
            <div class="col-lg-4">
                <input
                    type="text"
                    v-model="$parent.search_data.value"
                    class="form-control form-control-sm"
                    placeholder="Type your text"
                />
            </div>
            <div class="col-lg-4">
                <button type="submit" class="btn btn-sm table-search btn-danger">
                    Search  <i class="mdi mdi-database-search"></i>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
  props: ["fields_name"],
};
</script>

<style>
</style>
