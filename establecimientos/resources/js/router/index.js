import Vue from 'vue';
import VueRouter from 'vue-router';
import VuePageTransition from 'vue-page-transition';
import InicioEstablecimientos from '../components/InicioEstablecimientos';
import MostrarEstablecimiento from "../components/MostrarEstablecimiento";

const routes=[
    {
        path: '/', component: InicioEstablecimientos
    },
    {
        path: '/establecimiento/:id', component: MostrarEstablecimiento, name:'establecimiento'
    }
];
const router = new VueRouter({
    routes,
    //mode:'history'
});

Vue.use(VueRouter);
// la siguiente linea es para instalar el plugin
Vue.use(VuePageTransition);
export default router;
