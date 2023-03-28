<template>
  <div class="">
    <router-link
      v-if="$root.checkPermission(route)"
      :to="{
        name: route,
        query: { page: icon != 'plus' ? $route.query.page : '' },
      }"
      class="btn btn-xs btn-success add-and-back  pull-left text-white"
      :title="icon == 'plus' ? 'Add New' : 'Back to list'">
      <i :class="'mdi mdi-' + icon"></i>

      <span v-if="icon == 'plus'" class="text-capitalize">
            <b>Add {{ title ? title : portion }}</b>
      </span>
        <span v-else><b>Back</b></span>
    </router-link>

    <!-- custom route -->
    <slot v-if="extraButtons">
      <slot v-for="(rt, index) in extraButtons">
        <router-link
          :key="index"
          v-if="$root.checkPermission(rt.route)"
          :to="{ name: rt.route, params: { id: rt.slug ? rt.slug : '' } }"
          :class="'btn btn-xs btn-' + rt.btnColor"
          class="pull-left text-white top-button">
          <i :class="'mdi mdi-' + rt.icon"></i>
          <span class="text-capitalize">{{ rt.name }}</span>
        </router-link>
      </slot>
    </slot>
  </div>
</template>

<script>
export default {
  props: ["route", "icon", "portion", "title", "extraButtons"],
};
</script>
