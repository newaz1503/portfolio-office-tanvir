<template>
  <footer v-if="$root.site" class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Developed by:</b>
      <a target="_blank" :href="$root.site.developed_by_url">
        {{ $root.site.developed_by }}
      </a>
    </div>
    <strong>
      Copyright &copy; {{ year }}
      <a target="_blank" :href="$root.site.web"> {{ $root.site.title }} </a>.
    </strong>
    All rights reserved.
  </footer>
</template>

<script>
export default {
  data() {
    return {
      year: new Date().getFullYear(),
    };
  },
};
</script>