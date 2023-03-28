<template>
    <div :id="`navbarVerticalMenu${parents}`" class="nav-collapse collapse"
         :data-bs-parent="`#navbarVerticalMenu${parents}`">
        <div :id="`#navbarVerticalMenu${parents}`" v-if="childs && Object.keys( childs ).length > 0">
            <!-- Collapse -->
            <template v-for="(child, childIndex) in childs">
                <template v-if="child.child_menus && Object.keys(child.child_menus).length > 0">
                    <div class="nav-item"
                         :key="childIndex">
                        <a
                            class="nav-link dropdown-toggle "
                            :href="`#navbarVerticalMenu${child.id}`"
                            role="button"
                            data-bs-toggle="collapse"
                            :data-bs-target="`#navbarVerticalMenu${child.id}`"
                        >
                            {{ child.menu_name }}
                        </a>

                        <div :id="`navbarVerticalMenu${child.id}`"
                             class="nav-collapse collapse "
                             :data-bs-parent="`#navbarVerticalMenu${child.id}`">
                            <template v-for="(subChild,subIndex) in child.child_menus">
                                <router-link
                                    :key="subIndex"
                                    class="nav-link "
                                    v-if="subChild.params"
                                    :to="{ name: subChild.route_name, params: {  slug: subChild.params }}">
                                    {{ subChild.menu_name }}
                                </router-link>

                                <!-- SINGLE MENU -->
                                <router-link :key="subIndex" class="nav-link " v-else :to="{name: subChild.route_name }">
                                    {{subChild.menu_name}}
                                </router-link>
                            </template>
                        </div>
                    </div>
                </template>
                <template v-else>
                    <div class="nav-item" :key="childIndex"
                         v-if=" child.route_name && $root.checkPermission(child.route_name )">
                        <router-link
                            class="nav-link "
                            v-if="childs.params"
                            :to="{  name: child.route_name, params: { slug: child.params }}">
                            {{  child.menu_name }}
                        </router-link>

                        <!-- SINGLE MENU -->
                        <router-link class="nav-link " v-else :to="{ name: child.route_name}">
                            {{  child.menu_name }}
                        </router-link>
                    </div>
                </template>
            </template>


        </div>
    </div>
</template>

<script>
    export default {
        name: "LeftMenuRecursive",
        components: {
            RecursiveChildMenu: () => import("./LeftMenuRecursive.vue"),
        },
        props: ["childs", "parents"],
    };
</script>
