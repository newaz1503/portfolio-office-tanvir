import Vue from 'vue';

// ===============Login helpers=============
import User from "./../Login/User";
window.User = User;

// ===============Pagination===============
import Pagination from './../../components/backend/elements/Pagination'
Vue.component('Pagination', Pagination)

// ===============Spinner===============
import Spinner from './../../components/frontend/elements/Spinner'
Vue.component('Spinner', Spinner)

// ===============Breadcrumbs from vuex===============
import breadcrumbs from "../../vuex/breadcrumbs_frontend";
window.frontBreadcrumbs = breadcrumbs;

// ===============VueLazyload===============
import VueLazyload from 'vue-lazyload'
Vue.use(VueLazyload, {
    listenEvents: ['scroll', 'wheel', 'mousewheel', 'resize', 'animationend', 'transitionend']
})

// ===============Flash Message===============
import FlashMessage from '@smartweb/vue-flash-message';
Vue.use(FlashMessage);

import BootstrapVue from 'bootstrap-vue'
Vue.use(BootstrapVue);
import IconsPlugin from "bootstrap-vue/dist/bootstrap-vue.css";
Vue.use(IconsPlugin);

// ===============Simple Vue Validator===============
import SimpleVueValidation from "simple-vue-validator";
const Validator = SimpleVueValidation.Validator;
window.Validator = Validator;
Vue.use(SimpleVueValidation);

