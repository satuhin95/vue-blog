require('./bootstrap');
// vue js 
window.Vue = require('vue');


// vue router
import VueRouter from 'vue-router'

Vue.use(VueRouter)
// routes 
import {routes} from './routes/routes'

const router = new VueRouter({
  routes ,
  // mode: 'history',
});



// vuex
import Vuex from 'vuex'

Vue.use(Vuex);
import storeData from './store/store'

const store = new Vuex.Store(
  storeData
)

// moment
import {moment} from './filter/filter'

Vue.component('top-header', require('./components/frontend/Header.vue').default);
Vue.component('sidebar', require('./components/frontend/Sidebar.vue').default);
Vue.component('home-master', require('./components/frontend/HomeMaster.vue').default);

// mixin 
import './helpers/mixin'

// vue pagination
Vue.component('pagination', require('laravel-vue-pagination'));


const app = new Vue({
    el: '#app',
    router,
    store
});
