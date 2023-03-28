<template>
  <div>
    <div class="bg-light p-5 rounded">
      <!-- Slider Section-->
      <Slider />

      <!-- About Section-->
      <AboutUs />
    </div>
  </div>
</template>

<script>
import Slider from "./elements/Slider";
import AboutUs from "./elements/AboutUs";
export default {
  components: { Slider, AboutUs },
  data() {
    return {
      datas: { data: {} },
    };
  },
  mounted: function () {
    this.get_data("get-home-page", "data");
  },
};
</script>
