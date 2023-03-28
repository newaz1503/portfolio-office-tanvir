<template>
  <div class="box-header no-padding epp-content">
    <select
      @change="$parent.search"
      v-model="$parent.search_data.pagination"
      class="form-control form-control-sm paginate"
    >
      <option>10</option>
      <option>25</option>
      <option>50</option>
      <option>100</option>
      <option>200</option>
    </select>
    <div class="box-tools pull-right">
      <!-- print -->
      <a
        href="javascript:void(0)"
        class="btn btn-default btn-xs"
        @click="print('printArea', $parent.model)"
      >
        <i class="fa fa-print"></i> Print
      </a>
      <!-- /print -->
      <!-- PDF -->
      <a
        href="javascript:void(0)"
        class="btn btn-default btn-xs"
        @click="generatePdf"
      >
        <i class="fa fa-file-pdf-o"></i> Download PDF
      </a>
      <!-- /pdf -->
      <!-- Excel -->
      <download-excel
        v-if="$parent.table.datas"
        class="btn btn-default btn-xs"
        :data="$parent.table.datas"
        :fields="$parent.json_fields"
        :name="$parent.model + '.xls'"
      >
        <i class="fa fa-file-excel-o"></i> Export as Excel
      </download-excel>
      <!-- Excel -->
    </div>
  </div>
</template>

<script>
export default {
  methods: {
    generatePdf() {
      const doc = new jsPDF();
      $(".action").css("display", "none");
      autoTable(doc, { html: "#pdf-table" });
      doc.save(this.$parent.model + ".pdf");
      setTimeout(() => $(".action").show(), 300);
    },
  },
};
</script>