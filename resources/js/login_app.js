require('./login_bootstrap');
window.Vue = require('vue').default;
require('./Helpers/Backend/mixin');

// ===============Login helpers=============
import Admin from "./Helpers/Login/Admin";
window.Admin = Admin;

// ===============Spinner===============
import Spinner from './components/backend/elements/Spinner'
Vue.component('Spinner', Spinner)

// ===============Flash Message===============
import FlashMessage from '@smartweb/vue-flash-message';
Vue.use(FlashMessage);

// ===============Simple Vue Validator===============
import SimpleVueValidation from "simple-vue-validator";
const Validator = SimpleVueValidation.Validator;
window.Validator = Validator;
Vue.use(SimpleVueValidation);

Vue.component('login', require('./views/login/Login.vue').default);

// ===============app===============
const app = new Vue({
    el: '#app',
    data: {
        baseurl: laravel.baseurl,
        spinner: false,
    },
});
