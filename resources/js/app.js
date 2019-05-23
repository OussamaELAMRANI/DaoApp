import './bootstrap'
// Add From Npm packages
import Vue from 'vue'
// import vueRouter from 'vue-router'
//Side Bar for Dashboard
import VueSidebarMenu from 'vue-sidebar-menu'
import 'vue-sidebar-menu/dist/vue-sidebar-menu.css'
// Steps for large Form
import VueFormWizard from 'vue-form-wizard'
import 'vue-form-wizard/dist/vue-form-wizard.min.css'
import VueSelect from 'vue-cool-select'
import VeeValidate from 'vee-validate';
import VueNotification from "@kugatsu/vuenotification";


import VueQuillEditor from 'vue-quill-editor'

// require styles
import 'quill/dist/quill.core.css'
import 'quill/dist/quill.snow.css'
import 'quill/dist/quill.bubble.css'

Vue.use(VueQuillEditor, /* { default global options } */)


// Add From Local
import App from './App.vue'
import router from '@/routes'
import store from './store'
import '@/permission'; // permission control
import i18n from '@/lang'

// Plugins
// Vue.use(vueRouter)
Vue.use(VueSidebarMenu)
Vue.use(VueFormWizard)
Vue.use(VueSelect, {
    theme: 'bootstrap' // or 'material-design'
})
const validate_config = {
    aria: true,
    classNames: {},
    classes: false,
    delay: 0,
    dictionary: null,
    errorBagName: 'errors', // change if property conflicts
    events: 'input|blur',
    fieldsBagName: 'fields',
    i18n: null, // the vue-i18n plugin instance
    i18nRootKey: 'validations', // the nested key under which the validation messages will be located
    inject: true,
    locale: 'en',
    validity: false,
    useConstraintAttrs: true
};

Vue.use(VeeValidate, validate_config);

Vue.use(VueNotification);

/**
 * Global Filtering | pipeline truck
 */
Vue.filter('formal_date', function (date) {
    return moment(date).format('DD-MM-YYYY');
})


new Vue(Vue.util.extend({router, store, i18n}, App)).$mount('#app');
