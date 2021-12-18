

require('./bootstrap');

import Vue from 'vue';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
import VueRouter from 'vue-router'
import VueAxios from 'vue-axios'

/* importaciones de libreria */
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import router from './routes/index';

/* vue use */
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.use(VueRouter)
Vue.use(VueAxios, axios)

/* componentes globales */
Vue.component('layout', require('./components/layout.vue').default);

const app = new Vue({
    el: '#app',
    router,
});
