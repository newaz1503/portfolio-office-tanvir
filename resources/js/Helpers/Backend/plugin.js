import Vue from 'vue';

// ===============Login helpers=============
import Admin from "../Login/Admin";
window.Admin = Admin;

// ===============Breadcrumbs from vuex===============
import breadcrumbs from "../../vuex/breadcrumbs";
window.breadcrumbs = breadcrumbs;

// ===============profile from vuex===============
import profile from "../../vuex/profile";
window.profile = profile;

// ===============AddOrBackButton===============
import AddOrBackButton from './../../components/backend/elements/AddOrBackButton'
Vue.component('AddOrBackButton', AddOrBackButton)

// ===============Search===============
import Search from './../../components/backend/elements/Search'
Vue.component('Search', Search)

// ===============ViewBaseTable===============
import ViewBaseTable from './../../components/backend/elements/Table/ViewBaseTable'
Vue.component('ViewBaseTable', ViewBaseTable)

// ===============Pagination===============
import Pagination from './../../components/backend/elements/Table/Pagination'
Vue.component('Pagination', Pagination)

// ===============BaseTable===============
import BaseTable from './../../components/backend/elements/Table/BaseTable'
Vue.component('BaseTable', BaseTable)

// ===============TableSpinner===============
import TableSpinner from './../../components/backend/elements/Table/TableSpinner'
Vue.component('TableSpinner', TableSpinner)

// ===============Column Sorting===============
import ColumnSorting from './../../components/backend/elements/Table/ColumnSorting'
Vue.component('Sorting', ColumnSorting)

// ===============TableExcelPdfPrint===============
import TableExcelPdfPrint from './../../components/backend/elements/Table/TableExcelPdfPrint'
Vue.component('TableExcelPdfPrint', TableExcelPdfPrint)

// ===============ActionButton===============
import ActionButton from './../../components/backend/elements/Table/ActionButton'
Vue.component('ActionButton', ActionButton)

// ===============Input===============
import Input from './../../components/backend/elements/Form/Input'
Vue.component('Input', Input)

// ===============Select===============
import Select from './../../components/backend/elements/Form/Select'
Vue.component('Select', Select)

// ===============SelectCustom===============
import SelectCustom from './../../components/backend/elements/Form/SelectCustom'
Vue.component('SelectCustom', SelectCustom)

// ===============Radio===============
import Radio from './../../components/backend/elements/Form/Radio'
Vue.component('Radio', Radio)

// ===============Textarea===============
import Textarea from './../../components/backend/elements/Form/Textarea'
Vue.component('Textarea', Textarea)

// ===============File===============
import File from './../../components/backend/elements/Form/File'
Vue.component('File', File)

// ===============Button===============
import Button from './../../components/backend/elements/Form/Button'
Vue.component('Button', Button)

// ===============META DESCRIPTION===============
import Meta from './../../components/backend/elements/Form/Meta'
Vue.component('Meta', Meta)

// ===============CROP IMAGE===============
import Crop from './../../components/backend/elements/Crop'
Vue.component('Crop', Crop)

// ===============Spinner===============
import Spinner from './../../components/backend/elements/Spinner'
Vue.component('Spinner', Spinner)

// ===============Datepicker===============
import Datepicker from 'vuejs-datepicker';
Vue.component('datepicker', Datepicker);

// ===============Flash Message===============
import FlashMessage from '@smartweb/vue-flash-message';
Vue.use(FlashMessage);

// ===============js pdf===============
import jsPDF from 'jspdf';
window.jsPDF = jsPDF;
import autoTable from 'jspdf-autotable'
window.autoTable = autoTable;

// ===============Json Excel===============
import JsonExcel from 'vue-json-excel'
Vue.component('downloadExcel', JsonExcel)

// ===============Simple Vue Validator===============
import SimpleVueValidation from "simple-vue-validator";
const Validator = SimpleVueValidation.Validator;
window.Validator = Validator;
Vue.use(SimpleVueValidation);

// ===============CKEditor===============
import CKEditor from 'ckeditor4-vue';
Vue.use(CKEditor);
import CKEditorComponent from './../../components/backend/elements/CKEditor'
Vue.component('editor', CKEditorComponent)

// ===============Bootstrap Vue===============
import BootstrapVue from 'bootstrap-vue'
Vue.use(BootstrapVue);
