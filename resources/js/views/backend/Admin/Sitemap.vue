<template>
  <div v-if="!$root.spinner">
    <div class="row">
      <div
        v-for="(menu, index) in menus"
        :key="index"
        class="col-md-3 col-sm-6 col-xs-12"
      >
        <router-link
          :to="{ name: menu.route_name, params: { slug: menu.params } }"
        >
          <div class="info-box d-flex align-items-center">
            <span class="info-box-icon" :class="'bg-color-' + (index + 1)">
              <em v-if="menu.icon" v-html="menu.icon" class="fa-icon"></em>
            </span>

            <div class="info-box-content row ml-1">
              <span class="info-box-text">{{ menu.name }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </router-link>
        <!-- /.info-box -->
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Site Map</h3>
          </div>
          <div class="box-body">
            <ul v-if="$root.menus && Object.keys($root.menus).length > 0">
              <slot v-for="(root_menu, index) in $root.menus">
                <!-- ===================CHILDREN MENU=================== -->
                <slot
                  v-if="
                    root_menu.child_menus &&
                    Object.keys(root_menu.child_menus).length > 0
                  "
                >
                  <li :key="index">
                    <a href="javascript:void(0)">
                      <em v-if="root_menu.icon" v-html="root_menu.icon"></em>
                      <span>{{ root_menu.menu_name }}</span>
                      <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                      </span>
                    </a>
                    <SiteMapMenu
                      :key="index + 'A'"
                      :root_menu="root_menu.menu_name"
                      :child_menus="root_menu.child_menus"
                    />
                  </li>
                </slot>
                <!-- ===================CHILDREN MENU=================== -->

                <slot v-else>
                  <li :key="index" v-if="root_menu.route_name">
                    <!-- MENU  WITH PARAMS-->
                    <router-link
                      v-if="root_menu.params"
                      :to="{
                        name: root_menu.route_name,
                        params: { slug: root_menu.params },
                      }"
                    >
                      <em v-if="root_menu.icon" v-html="root_menu.icon"></em>
                      <span>{{ root_menu.menu_name }}</span>
                    </router-link>

                    <!-- SINGLE MENU -->
                    <router-link v-else :to="{ name: root_menu.route_name }">
                      <em v-if="root_menu.icon" v-html="root_menu.icon"></em>
                      <span>{{ root_menu.menu_name }}</span>
                    </router-link>
                  </li>
                </slot>
              </slot>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import SiteMapMenu from "./SiteMapMenu";
const breadcrumb = [{ route: "admin.sitemap", title: "Site Map" }];
export default {
  components: { SiteMapMenu },
  data() {
    return {
      menus: [],
    };
  },
  methods: {},
  created() {
    breadcrumbs.dispatch("setBreadcrumbs", breadcrumb);
  },
};
</script>