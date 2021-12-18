import Vue from 'vue'
import VueRouter from 'vue-router'

import Home from '../pages/Home.vue';
import Actividad from '../pages/Actividad.vue';

const routes = [
    {path:'/', component:Home},
    {path:'/reservas', component:Home},
    {path:'/actividad/:id', component:Actividad},
]

const router = new VueRouter({
    mode: 'history',
    routes
});

export default router;
