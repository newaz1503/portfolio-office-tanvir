<template>
    <div class="">
        <div class="leftside-menu">
            <!-- Logo Light -->
            <router-link :to="{ name: 'admin.dashboard' }" class="logo logo-light">
                <span class="logo-lg">
                    <!-- <img
                        :src="$root.baseurl + '/admin/images/logo.png'"
                        alt="logo"
                        height="50"
                    /> -->
                    <h3>Tanvir Ahmed</h3>
                </span>
                <span class="logo-sm">
                    <img
                        :src="$root.baseurl + '/admin/images/logo-sm.png'"
                        alt="small logo"
                        height="22"
                    />
                </span>
            </router-link>

            <!-- Logo Dark -->
            <router-link :to="{ name: 'admin.dashboard' }" class="logo logo-dark">
                <span class="logo-lg">
                    <img
                        :src="$root.baseurl + '/admin/images/logo-dark.png'"
                        alt="dark logo"
                        height="50"
                    />
                </span>
                <span class="logo-sm">
                    <img
                        :src="$root.baseurl + '/admin/images/logo-dark-sm.png'"
                        alt="small logo"
                        height="22"
                    />
                </span>
            </router-link>

            <!-- Sidebar Hover Menu Toggle Button -->
            <button
                type="button"
                class="btn button-sm-hover p-0"
                data-bs-toggle="tooltip"
                data-bs-placement="right"
                title="Show Full Sidebar"
            >
                <i class="ri-checkbox-blank-circle-line align-middle"></i>
            </button>

            <!-- Sidebar -left -->
            <div class="h-100" id="leftside-menu-container" data-simplebar>
                <!-- Sidemenu -->
                <ul class="side-nav" >
                    <li class="side-nav-item">
                        <router-link class="side-nav-link" :to="{ name: 'admin.dashboard' }">
                            <i class="uil-home-alt"></i>
                            <span> Dashboard </span>
                        </router-link>
                    </li>
                    <li class="side-nav-title side-nav-item">Pages</li>
                    <template v-for="(parents,parentIndex) in $root.menus">
                        <template v-if="parents.child_menus && Object.keys(parents.child_menus).length > 0 ">
                            <li class="side-nav-item" :key="parentIndex">
                                <a
                                    data-bs-toggle="collapse"
                                    :href="`#navigationmenu${parents.id}`"
                                    aria-expanded="false"
                                    :aria-controls="`#navigationmenu${parents.id}`"
                                    class="side-nav-link"
                                >
                                    <em v-if="parents.icon" v-html="parents.icon"></em>
                                    <span> {{ parents.menu_name }} </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" :id="`navigationmenu${parents.id}`">
                                    <ul class="side-nav-second-level">
                                        <template v-for="(childs,childIndex) in parents.child_menus">
                                            <template v-if="childs.child_menus && Object.keys(childs.child_menus).length > 0">
                                                <li :key="childIndex" class="side-nav-item">
                                                    <a
                                                        data-bs-toggle="collapse"
                                                        :href="`#navigationchildmenu${childs.id}`"
                                                        aria-expanded="false"
                                                        :aria-controls="`#navigationchildmenu${childs.id}`"
                                                    >
                                                        <em v-if="childs.icon" v-html="childs.icon"></em>
                                                        <span> {{ childs.menu_name }} </span>
                                                        <span class="menu-arrow"></span>
                                                    </a>
                                                    <div
                                                        class="collapse"
                                                        :id="`navigationchildmenu${childs.id}`"
                                                    >
                                                        <ul class="side-nav-third-level">
                                                            <li class="side-nav-item" v-for="(subChild,subchildIndex) in childs.child_menus" :key="subchildIndex"
                                                                v-if="subChild.route_name && $root.checkPermission(subChild.route_name ) ">
                                                                <router-link
                                                                    v-if="subChild.params"
                                                                    :to="{name: subChild.route_name,  params: { slug: subChild.params } }">
                                                                    <em v-if="subChild.icon" v-html="subChild.icon"></em>
                                                                    <span>{{ subChild.menu_name }}</span>
                                                                </router-link>

                                                                <!-- SINGLE MENU -->
                                                                <router-link v-else :to="{ name: subChild.route_name }">
                                                                    <em v-if="subChild.icon" v-html="subChild.icon"></em>
                                                                    <span>{{ subChild.menu_name }}</span>
                                                                </router-link>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </li>
                                            </template>
                                            <template v-else>
                                                <li :key="childIndex"
                                                    v-if="childs.route_name && $root.checkPermission(childs.route_name ) ">
                                                    <router-link
                                                        v-if="childs.params"
                                                        :to="{name: childs.route_name,  params: { slug: childs.params } }">
                                                        <em v-if="childs.icon" v-html="childs.icon"></em>
                                                        <span>{{ childs.menu_name }}</span>
                                                    </router-link>

                                                    <!-- SINGLE MENU -->
                                                    <router-link v-else :to="{ name: childs.route_name }">
                                                        <em v-if="childs.icon" v-html="childs.icon"></em>
                                                        <span>{{ childs.menu_name }}</span>
                                                    </router-link>
                                                </li>
                                            </template>
                                        </template>
                                    </ul>
                                </div>
                            </li>
                        </template>
                        <template v-else>
                            <li class="side-nav-item" :key="parentIndex"
                                v-if="parents.route_name && $root.checkPermission(parents.route_name ) ">
                                <router-link
                                    class="side-nav-link"
                                    v-if="parents.params"
                                    :to="{name: parents.route_name,  params: { slug: parents.params } }">
                                    <em v-if="parents.icon" v-html="parents.icon"></em>
                                    <span>{{ parents.menu_name }}</span>
                                </router-link>

                                <!-- SINGLE MENU -->
                                <router-link class="side-nav-link" v-else :to="{ name: parents.route_name }">
                                    <em v-if="parents.icon" v-html="parents.icon"></em>
                                    <span>{{ parents.menu_name }}</span>
                                </router-link>
                            </li>
                        </template>
                    </template>
                </ul>
                <!-- End Sidemenu -->
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</template>

<script>
    import RecursiveMenu from "./LeftMenuRecursive";

    export default {
        components: {
            RecursiveMenu
        },
        data() {
            return {
                logged_id: "",
                logged_name: ""
            };
        },
        computed: {
            profileImage() {
                return profile.state.image;
            }
        },
        created() {
            this.logged_id = Admin.id();
            this.logged_name = Admin.name();
            setTimeout(() => {
                $("#sidebar_menu")
                    .find("a")
                    .removeClass("active");
                console.log();
                $("#sidebar_menu")
                    .find("li")
                    .removeClass("mm-active");
                $("#sidebar_menu")
                    .find("li ul")
                    .removeClass("mm-show");
                var current = window.location.pathname;
                $("#sidebar_menu >li a").filter(function () {
                    var link = $(this).attr("href");
                    if (link) {
                        if (current.indexOf(link) != -1) {
                            $(this)
                                .parents()
                                .parents()
                                .children("ul.mm-collapse")
                                .addClass("mm-show")
                                .closest("li")
                                .addClass("mm-active");
                            $(this).addClass("active");
                            return false;
                        }
                    }
                });
            }, 2000);
        }
    };
</script>
<style>
    html[data-sidenav-color=dark] .side-nav .side-nav-link {
        color: var(--ct-dark-menu-item-active);
    }
</style>
