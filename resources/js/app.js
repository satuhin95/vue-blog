

require('./bootstrap');
// vue js 
window.Vue = require('vue');


// vform 
import Form from 'vform';
window.Form = Form;
import {  HasError, AlertError} from 'vform/src/components/bootstrap5'
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
// vue router
import VueRouter from 'vue-router'

Vue.use(VueRouter)
// routes 
import {routes} from './routes/routes'

const router = new VueRouter({
  routes ,
  // mode: 'history',
});

// sweetalert 
import Swal from 'sweetalert2'
window.Swal = Swal;
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

window.Toast = Toast;

// toster 
import toastr from 'toastr'
window.toastr = toastr;

// vuex
import Vuex from 'vuex'

Vue.use(Vuex);
import storeData from './store/store'

const store = new Vuex.Store(
  storeData
)

// moment
import {moment} from './filter/filter'

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

// mixin 
import './helpers/mixin'

// ckeditor 
import CKEditor from '@ckeditor/ckeditor5-vue2';

Vue.use( CKEditor );

const app = new Vue({
    el: '#app',
    router,
    store
});
