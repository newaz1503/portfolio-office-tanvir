<template>
    <div class="card shadow-none">
        <div class="d-flex card-header justify-content-between align-items-center">
            <h4 class="header-title"><i class="mdi mdi-view-dashboard-edit-outline h5"></i> Steps to complete a module.</h4>
            <div class="col-lg-2 text-end">
                <router-link
                    :to="{ name: model + '.create' }"
                    class="btn btn-xs btn-success pull-left text-white"
                    title="Module Created File"
                >
                    <i class="fa fa-eye"></i> Back
                </router-link>
            </div>
        </div>
        <div class="card-body py-0 mb-3" data-simplebar style="max-height: 403px;">
            <div class="timeline-alt py-0">
                <div class="timeline-item">
                    <i class="mdi mdi-format-list-bulleted bg-info-lighten text-success timeline-icon"></i>
                    <div class="timeline-item-info">
                        <a href="javascript:void(0);" class="text-success fw-bold mb-1 d-block">
                            Laravel Route:
                        </a>
                        <small>
                            You just copy this route and paste this inner <span class="fw-bold">'auth:acces'</span> middleware
                        </small>
                        <p class="mb-0 pb-2">
                            <small class="text-muted">File Location: routes/backend.php </small>
                        </p>
                    </div>
                </div>

                <div class="timeline-item">
                    <i class="mdi mdi-content-copy bg-primary-lighten text-primary timeline-icon"></i>
                    <div class="timeline-item-info">
                        <a href="javascript:void(0);" class="text-primary fw-bold mb-1 d-block">Vue Route:</a>
                        <small>
                            You just copy this route and paste it in <span class="fw-bold">router.js</span>  middleware
                        </small>
                        <p class="mb-0 pb-2">
                            // ------------------<span class="text-uppercase"
                        >{{ data.name }} PORTION</span
                        >------------------ <br />
                            <small class="text-muted">
                                { path: '/{{ data.route }}', name: '{{ data.route }}.index',
                                meta: { title: '{{ data.name }}', nav: true }, component: ()
                                => import('./../views/backend/{{ data.name }}/Index'),
                                beforeEnter: authGuard },
                                <br />
                                { path: '/{{ data.route }}/create', name: '{{
                                data.route
                                }}.create', component: () => import('./../views/backend/{{
                                data.name
                                }}/Create'), beforeEnter: authGuard },
                                <br />
                                { path: '/{{ data.route }}/:id', name: '{{
                                data.route
                                }}.show', component: () => import('./../views/backend/{{
                                data.name
                                }}/View'), beforeEnter: authGuard },
                                <br />
                                { path: '/{{ data.route }}/:id/edit', name: '{{
                                data.route
                                }}.edit', component: () => import('./../views/backend/{{
                                data.name
                                }}/Create'), beforeEnter: authGuard },
                                <br />
                            </small>
                        </p>
                        <p class="mb-0 pb-2">
                            <small class="text-muted">File Location: resources/js/Router/router.js </small>
                        </p>
                    </div>
                </div>

                <div class="timeline-item">
                    <i class="mdi mdi-database-plus-outline bg-info-lighten text-success timeline-icon"></i>
                    <div class="timeline-item-info">
                        <a href="javascript:void(0);" class="text-success fw-bold mb-1 d-block">
                            Database: {{ data.database }}
                        </a>
                        <small>
                            Add your needed field in migration file, and run this command php artisan migrate
                        </small>
                        <p class="mb-0 pb-2">
                            <small class="text-muted">File Location: migration/databases/migration_file.php</small>
                        </p>
                    </div>
                </div>

                <div class="timeline-item">
                    <i class="mdi mdi-upload bg-primary-lighten text-primary timeline-icon"></i>
                    <div class="timeline-item-info">
                        <a href="javascript:void(0);" class="text-primary fw-bold mb-1 d-block">
                            Vue File: {{ data.vue_file }}
                        </a>
                        <small>
                            Customize your Create.vue form as you wish
                            please provide validation rule each and every field, validation rules are given at the bottom of the page
                        </small>
                    </div>
                </div>

                <div class="timeline-item">
                    <i class="mdi mdi-upload bg-info-lighten text-success timeline-icon"></i>
                    <div class="timeline-item-info">
                        <a href="javascript:void(0);" class="text-success fw-bold mb-1 d-block">
                            Controller: {{  data.controller }}
                        </a>
                    </div>
                </div>

                <div class="timeline-item">
                    <i class="mdi mdi-airplane bg-primary-lighten text-primary timeline-icon"></i>
                    <div class="timeline-item-info">
                        <a href="javascript:void(0);" class="text-primary fw-bold mb-1 d-block">
                            Model: {{ data.model }}
                        </a>
                    </div>
                </div>

                <div class="timeline-item">
                    <i class="mdi mdi-microphone bg-info-lighten text-success timeline-icon"></i>
                    <div class="timeline-item-info">
                        <a href="javascript:void(0);" class="text-success fw-bold mb-1 d-block">
                            {{ data.resource }}
                        </a>
                    </div>
                </div>
                <div class="timeline-item">
                    <i class="mdi mdi-microphone bg-info-lighten text-success timeline-icon"></i>
                    <div class="timeline-item-info">
                        <a href="javascript:void(0);" class="text-success fw-bold mb-1 d-block">
                            Notes:
                        </a>
                        <small>
                            Please add this menu to seeder file for backup database/seeders/MenuSeeder.php
                            Your menu has been created and the {{ data.name }} menu is at the top of the Dashboard menu. You will see after reloading.
                            Finally reload the browser ( ctrl + f5 ).
                        </small>
                    </div>
                </div>
                <div class="timeline-item">
                    <i class="mdi mdi-microphone bg-info-lighten text-success timeline-icon"></i>
                    <div class="timeline-item-info">
                        <a href="javascript:void(0);" class="text-success fw-bold mb-1 d-block">
                            If you complete all the processes then your module is ready to work
                        </a>
                    </div>
                </div>
                <div class="timeline-item">
                    <i class="mdi mdi-microphone bg-info-lighten text-success timeline-icon"></i>
                    <div class="timeline-item-info">
                        <a href="javascript:void(0);" class="text-success fw-bold mb-1 d-block">
                            Congrats !! Go ahead
                        </a>
                    </div>
                </div>
            </div>
            <!-- end timeline -->
            <a
                @click="systemRoleUpdate"
                class="btn btn-xs mr-2 btn-success pull-left text-white"
            >
                <i class="fa fa-refresh"></i>
                <span class="text-capitalize">Update System Role</span>
            </a>
            <a
                target="_blank"
                :href="$root.baseurl + '/clear'"
                class="btn btn-xs mr-2 btn-danger pull-left text-white"
            >
                <i class="fa fa-refresh"></i>
                <span class="text-capitalize">Clear</span>
            </a>
        </div> <!-- end slimscroll -->
    </div>
</template>

<script>
// define model name
const model = "module";
// set breadcrumb
const breadcrumb = [
  { route: "module.create", title: "Module Create" },
  { route: "module.index", title: "Module Created File" },
];

export default {
  data() {
    return {
      model: model,
      data: {},
    };
  },
  methods: {
    getRules: function () {
      this.$root.spinner = true;
      axios
        .get("/module/create", {
          params: { model_name: this.$route.params.model },
        })
        .then((res) => (this.data = res.data))
        .catch((error) => console.log(error))
        .then((alw) => setTimeout(() => (this.$root.spinner = false), 300));
    },
    systemRoleUpdate() {
      axios.get("/systems-update").then((res) => {
        this.notification(res.data.message, "success");
      });
    },
  },
  created() {
    this.getRules(); // get rules
    breadcrumbs.dispatch("setBreadcrumbs", breadcrumb); // Set Breadcrumbs
  },
};
</script>
