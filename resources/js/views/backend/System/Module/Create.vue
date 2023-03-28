<template>
    <div class="card">
        <div class="card-body">
            <div class="row mb-3 justify-content-end">
                <div class="col-lg-3 text-end">
                    <router-link
                        :to="{ name: model + '.index' }"
                        class="btn btn-xs btn-success pull-left text-white"
                        title="Module Created File"
                    >
                        <i class="fa fa-eye"></i> Module Created File
                    </router-link>
                </div>
            </div>
            <div class="form mb-5">
                <div class="row justify-content-center">
                    <div class="form-row col-5 border border-success p-4 rounded">
                        <!------------ Single Input ------------>
                        <div
                            class="form-row"
                            :class="{
              'has-error': validation.hasError('data.model_name'),
              'has-success': data.model_name,
            }"
                        >
                            <label class="col-4">
                                Model Name :
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-12">
                                <input
                                    type="text"
                                    v-model="data.model_name"
                                    class="form-control form-control-sm"
                                    placeholder="Model Name"
                                />
                                <span class="help-block">{{
                validation.firstError("data.model_name")
              }}</span>
                            </div>

                            <div class="row mt-2">
                                <label class="col-4">Only Model :</label>
                                <div class="col-7">
                                    <input type="checkbox" value="1" v-model="data.only_model"/>
                                </div>
                            </div>
                        </div>

                        <!-------------- button -------------->
                        <div class="col-4 mt-3">
                            <button
                                @click="submit"
                                type="submit"
                                :disabled="validation.countErrors() > 0 || disabled ? true : false"
                                class="btn btn-sm btn-success">
                                <span v-if="disabled">
                                    <span class="spinner-border spinner-border-sm me-1" role="status"
                                          aria-hidden="true"></span>
                                    Loading...
                                </span>
                                <span v-else>Submit</span>
                            </button>
                        </div>
                        <!-------------- button -------------->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    // ===============Promise===============
    import Promise from "bluebird";
    // define model name
    const model = "module";
    // set breadcrumb
    const breadcrumb = [{route: "module.create", title: "Module Create"}];

    export default {
        data() {
            return {
                model: model,
                disabled: false,
                model_exist: false,
                data: {},
                files: {},
            };
        },
        methods: {
            submit: function () {
                const error = this.validation.countErrors();
                this.$validate().then((res) => {
                    if (res) {
                        this.$root.spinner = true;
                        axios
                            .post("/module/create", this.data)
                            .then((res) => {
                                this.notification("Module Create Successfully", "success");
                                this.$router.push({
                                    name: this.model + ".index",
                                    params: {model: this.data.model_name},
                                });
                            })
                            .catch((error) =>
                                this.notification(
                                    "Something went wrong, but Some file are crated, please check",
                                    "error"
                                )
                            )
                            .then((alw) => setTimeout(() => (this.$root.spinner = false), 200));
                    }
                });
            },
        },
        created() {
            breadcrumbs.dispatch("setBreadcrumbs", breadcrumb); // Set Breadcrumbs
        },

        // ================== validation rule for form ==================
        validators: {
            "data.model_name": function (value = null) {
                var app = this;
                return Validator.value(value)
                    .required("Model Name is required")
                    .minLength(3)
                    .regex("^[a-zA-Z_]*$", "Must only contain alphabetic characters.")
                    .regex("(?=.*?[A-Z])", "at least one uppercase letter required")
                    .regex("(?=.*?[a-z])", "at least one lowercase letter required")
                    .custom(function () {
                        if (!Validator.isEmpty(value)) {
                            app.disabled = true;
                            axios
                                .get("/module/check-model", {
                                    params: {model_name: app.data.model_name},
                                })
                                .then((res) => {
                                    if (res.data) {
                                        app.model_exist = true;
                                    } else {
                                        app.model_exist = false;
                                    }
                                });
                            return Promise.delay(1500).then(function () {
                                if (app.model_exist) {
                                    return "Model name already exists";
                                }
                                app.disabled = false;
                            });
                        }
                    });
            },
        },
    };
</script>
