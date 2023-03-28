<template>
  <div>
    <router-link
      v-if="routes.view && $root.checkPermission(routes.view)"
      :to="{
        name: routes.view,
        params: { id: data.id },}"
      class="btn btn-xs btn-success action-view"
      title="View"
    >
      <i class="fa fa-eye"></i>
    </router-link>

    <router-link
      v-if="routes.edit && $root.checkPermission(routes.edit)"
      :to="{
        name: routes.edit,
        params: { id: data.id },
      }"
      class="btn btn-xs btn-primary action-pencil"
      title="Edit"
    >
      <i class="fa fa-pencil"></i>
    </router-link>

    <button
      v-if="routes.destroy && $root.checkPermission(routes.destroy)"
      v-on:click="$parent.destroy(data.id)"
      class="btn btn-xs btn-danger action-trash"
      title="Delete"
    >
      <i class="fa fa-trash"></i>
    </button>
  </div>
</template>

<script>
export default {
  props: ["routes", "data"],
};
</script>
