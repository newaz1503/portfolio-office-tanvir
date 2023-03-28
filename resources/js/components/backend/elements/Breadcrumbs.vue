<template>
    <div class="page-title-box">
        <div class="page-title-right">
            <nav aria-label="breadcrumb" v-if="breadcrumbLevels[0] && Object.keys(breadcrumbLevels[0]).length > 0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <router-link class="breadcrumb-link" :to="{ name: 'admin.dashboard' }">Dashboard</router-link>
                    </li>
                    <template v-for="(menu, index1) in breadcrumbLevels[0]">
                        <li v-if="menu.route !== $route.name" class="breadcrumb-item">
                            <router-link class="breadcrumb-link text-capitalize" :to="{name: menu.route, params: { slug: menu.slug ? menu.slug : '' },}">
                                {{ menu.title }}
                            </router-link>
                        </li>
                        <li  :key="index1" v-if="menu.route === $route.name" class="breadcrumb-item active text-capitalize" aria-current="page">{{ menu.title }}</li>
                    </template>
                </ol>
            </nav>
        </div>
        <h2 class="page-title text-capitalize">
            {{breadcrumbLevels[0] ? breadcrumbLevels[0][Object.keys(breadcrumbLevels[0]).length - 1]["title"] : "" }}
        </h2>
    </div>
</template>

<script>
export default {
    methods: {
        removeMenu(index) {
            breadcrumbs.dispatch("removeMenu", index);
        },
    },
    computed: {
        breadcrumbLevels() {
            return breadcrumbs.state.breadcrumbLevels;
        },
        menuTags() {
            return breadcrumbs.state.menuTags;
        },
    },
};
</script>
