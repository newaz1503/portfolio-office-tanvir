<template>
  <nav
    class="navbar navbar-expand-md navbar-dark fixed-top"
    style="background: #04668c"
  >
    <div class="container">
      <router-link class="navbar-brand" :to="{ name: 'front.home' }"
        >OSHIT SUTRADAR</router-link
      >
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarCollapse"
        aria-controls="navbarCollapse"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
            <router-link class="nav-link" :to="{ name: 'front.home' }"
              >Home</router-link
            >
          </li>
          <li class="nav-item">
            <router-link class="nav-link" :to="{ name: 'user.dashboard' }"
              >Dashoard</router-link
            >
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About Us</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  name: "Header",
  data() {
    return {
      data: {},
    };
  },
  methods: {},
  mounted() {},
};
</script>
