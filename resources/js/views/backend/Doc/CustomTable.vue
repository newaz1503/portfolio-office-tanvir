<template>
  <div>
    <!-- ================Excel , PDF, Print Button================ -->
    <TableExcelPdfPrint />

    <div class="col-12 no-padding" id="printArea">
      <div class="table-responsive">
        <table
          id="pdf-table"
          class="table table-bordered table-hover table-striped"
          border="1"
        >
          <thead
            class="text-white base-table-thead"
            style="background: #3c8dbc"
          >
            <tr>
              <th class="sl">#</th>
              <Sorting column="name" title="Name" />
              <th>Name</th>
              <th>Status</th>
              <th class="action">Action</th>
            </tr>
          </thead>

          <slot v-if="!$root.tableSpinner">
            <tbody v-if="Object.keys(table.datas).length > 0">
              <slot v-for="(data, index) in table.datas">
                <tr :key="index">
                  <td>{{ index + 1 }}</td>
                  <td>{{ data.name }}</td>
                  <td>{{ data.name }}</td>
                  <td>{{ data.status }}</td>
                  <td class="action">
                    <ActionButton :routes="table.routes" :data="data" />
                    <!--                       
                    <router-link
                      v-if="
                        table.routes.view &&
                        $root.checkPermission(table.routes.view)
                      "
                      :to="{ name: table.routes.view, params: { id: data.id } }"
                      class="btn btn-xs btn-success action-view"
                      title="View"
                    >
                      <i class="fa fa-eye"></i>
                    </router-link>

                    <router-link
                      v-if="
                        table.routes.edit &&
                        $root.checkPermission(table.routes.edit)
                      "
                      :to="{ name: table.routes.edit, params: { id: data.id } }"
                      class="btn btn-xs btn-primary action-pencil"
                      title="Edit"
                    >
                      <i class="fa fa-pencil"></i>
                    </router-link>

                    <button
                      v-if="
                        table.routes.destroy &&
                        $root.checkPermission(table.routes.destroy)
                      "
                      v-on:click="destroy(data.id)"
                      class="btn btn-xs btn-danger action-trash"
                      title="Delete"
                    >
                      <i class="fa fa-trash"></i>
                    </button> -->
                  </td>
                </tr>
              </slot>
            </tbody>
            <tbody v-else>
              <tr>
                <td colspan="3">
                  <p class="p-2 text-center text-red no-data">No data found.</p>
                </td>
              </tr>
            </tbody>
          </slot>
        </table>

        <!-- Table Spinner -->
        <TableSpinner />
      </div>
    </div>
  </div>
</template>
