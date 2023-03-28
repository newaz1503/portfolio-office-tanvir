<template>
    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-4 col-lg-5">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="text-center w-75 m-auto">
                                <h2 class="text-dark-50 text-center pb-0 fw-bold">Sign In</h2>
                                <p class="text-muted mb-4">Enter your email address and password to access admin panel.</p>
                            </div>
                            <form v-on:submit.prevent="submit" method="post" class="login">

                                <div class="mb-3">
                                    <label for="emailaddress" class="form-label">Email address</label>
                                    <input
                                        class="form-control"
                                        type="email" id="emailaddress"
                                        v-model="data.email"
                                        placeholder="User name / Email"
                                    />
                                    <div class="text-danger">
                                        {{ validation.firstError("data.email") }}
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group input-group-merge">
                                        <input
                                            :type="passwordIstext ? 'text' : 'password'"
                                            v-model="data.password"
                                            id="password"
                                            class="form-control"
                                            placeholder="Enter your password"
                                        >
                                        <a
                                            href="javascript:void(0)"
                                            class="input-group-text"
                                            @click="passwordIstext = !passwordIstext"
                                        >
                                            <i class="mdi mdi-eye-off" v-if="!passwordIstext"></i>
                                            <i class="mdi mdi-eye" v-else></i>
                                        </a>
                                    </div>
                                    <div class="text-danger">
                                        {{ validation.firstError("data.password") }}
                                    </div>
                                </div>

                                <div class="mb-3 mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="checkbox-signin" checked="">
                                        <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                    </div>
                                </div>

                                <div class="mb-3 mb-0 text-center">
                                    <button v-if="!$root.spinner" class="btn btn-primary" type="submit"> Log In </button>
                                    <button v-else class="btn btn-primary" type="button" disabled>
                                        <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                                        Loading...
                                    </button>
                                </div>
                            </form>
                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->
                </div> <!-- end col -->
            </div>
        </div>
        <!-- end container -->
    </div>
</template>

<script>
export default {
  data() {
    return {
      passwordIstext: false,
      data: {
        email: "",
        password: "",
      },
    };
  },
  methods: {
    submit() {
      const error = this.validation.countErrors();
      this.$validate().then((res) => {
        if (res) {
          this.$root.spinner = true;
          axios
            .post("/admin/login-admin", this.data)
            .then((res) => {
              if (res.status == 200 && res.data.id) {
                Admin.login(res.data);
                this.notification(res.data.message, "success");
                window.location = this.$root.baseurl + "/admin/dashboard";
              } else {
                this.$root.spinner = false;
                this.notification(res.data.message, "error");
              }
            })
            .catch((error) => {
              this.$root.spinner = false;
              this.notification(
                "Something went wrong, please try again",
                "error"
              );
            });
        }
      });
    },
  },

    // ================== validation rule for form ==================
  validators: {
    "data.email": function (value = null) {
      return Validator.value(value).required("Email is required");
    },
    "data.password": function (value = null) {
      return Validator.value(value)
        .required("Password is required")
        .minLength(6);
    },
  },
};
</script>
