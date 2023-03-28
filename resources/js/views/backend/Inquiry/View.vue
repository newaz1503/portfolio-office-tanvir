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
              <div class="view-table">
                 <!--============ View Base Table Start ============-->
                      <ViewBaseTable :data="data" />
                      <!--============ View Base Table End ============-->
              </div>
          </div>
        </div>
</template>

<script>
// define model name
const model = "inquiry";

export default {
  data() {
    return {
      model: model,
      data: []
    };
  },
  async created() {
    await this.get_data(this.model, this.$route.params.id, "data"); // get data
    this.setBreadcrumbs(this.model, "view"); // Set Breadcrumbs
  }
};
</script>
