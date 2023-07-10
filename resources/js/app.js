//dependencies
require('./bootstrap');
window.Vue = require('vue').default;

//default import
import { Form, HasError, AlertError,AlertErrors, AlertSuccess} from 'vform';
import router from './router';
import { filter } from './filter';
import storeData from "./store/index";
import Vuex from 'vuex';

// importations
import Roles from './components/essentials/Roles.vue';
import Auth from './components/essentials/Auth.vue';
import Others from './components/essentials/Others.vue';

import Swal from 'sweetalert2';
import VueGoodTablePlugin from 'vue-good-table';
import 'vue-good-table/dist/vue-good-table.css';
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";

// vue mxins
const toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});
window.toast = toast;

// Vue.mixin(Roles);
// Vue.mixin(Auth);
Vue.mixin(Others);


// vue use?
Vue.use(Vuex);
Vue.use(VueGoodTablePlugin);

//vue componen
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
Vue.component(AlertErrors.name, AlertErrors);
Vue.component(AlertSuccess.name, AlertSuccess);
window.Form = Form;

// Vue.component('authmaster', require('./components/AuthEndMaster.vue').default);
Vue.component('guestmaster', require('./components/GuestEndMaster.vue').default);

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!store.getters.Auth) {
            let reroute = window.location.replace('/');
            next({
                reroute
            });
        } else{
            next();
        }
    }
    else {
        next(); // make sure to always call next()!
    }
});

const store = new Vuex.Store(
    storeData
);

Vue.config.productionTip = false

const app = new Vue({
    el: '#app',
    router: router,
    store: store,
});
