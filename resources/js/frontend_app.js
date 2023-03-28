require('./frontend_bootstrap');
window.Vue = require('vue').default;
require('./Helpers/Frontend/crud');
require('./Helpers/Backend/filter');
require('./Helpers/Frontend/mixin');
require('./Helpers/Frontend/plugin');

// ===============router=============
import router from "./Router/frontend_router.js";

Vue.component('app', require('./components/FrontendApp.vue').default);
// ===============app===============
const app = new Vue({
    el: '#app',
    router,
    data: {
        baseurl: laravel.baseurl,
        spinner: false,
        userLoggedIn: false,
        userimage: laravel.baseurl + '/public/images/user.png',
        noimage: laravel.baseurl + '/public/images/noimage.png',
        attach: laravel.baseurl + '/public/images/attach.png',
        pageNumber: 1,
        menus: [],
        config: [],
        global: []
    },
    methods: {
        getMenus: function () {
            axios.get("/get-menus")
                .then(res => {
                    this.menus = res.data.menus;
                    this.config = res.data.config;
                });
        },
        globalData: function () {
            axios.get('/global-data').then(res => (this.global = res.data));
        },
    },
    mounted() {
        this.getMenus();
        this.globalData();
        this.userLoggedIn = Boolean(User.loggedIn());
    },
    created() {
        // active parent menu
        // $('.nav-item').children('.nav-link').removeClass('parent-active')
        // setTimeout(() => {
        //     $('.router-link-exact-active').parents('.dropdown-menu').siblings('#navbarDropdown').addClass('parent-active');
        // }, 3000);
    }
});
