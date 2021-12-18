

require('./bootstrap');

import Vue from 'vue';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
import VueRouter from 'vue-router'
import VueAxios from 'vue-axios'
import Vuex from 'vuex'

/* importaciones de libreria */
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import router from './routes/index';
import store from './store/index';

/* vue use */
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.use(VueRouter)
Vue.use(VueAxios, axios)
Vue.use(Vuex)

/* componentes globales */
Vue.component('layout', require('./components/layout.vue').default);

const app = new Vue({
    el: '#app',
    router,
    store,
});
