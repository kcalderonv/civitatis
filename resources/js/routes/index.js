import Vue from 'vue'
import VueRouter from 'vue-router'

import Home from '../pages/Home.vue';
import Actividad from '../pages/Actividad.vue';
import Register from '../pages/Register.vue';
import Reservado from '../pages/Reservado.vue';
import Reservas from '../pages/Reservas.vue';

const routes = [
    {path:'/', component:Home},
    {path:'/actividad/:id', component:Actividad},
    {path:'/ingresar', component:Register},
    {path:'/reservado', component:Reservado, name:'Reservado'},
    {path:'/reservas', component:Reservas},
    {path:'/*', component:Home},
];

const router = new VueRouter({
    mode: 'history',
    routes
});

export default router;
