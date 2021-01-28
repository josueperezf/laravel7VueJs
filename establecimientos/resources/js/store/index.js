import Vue from 'vue';
import Vuex from 'vuex';

// la siguiente linea es para decirle a vue que use o instale el plugin Vuex
Vue.use(Vuex);

export default new Vuex.Store({
    state:{
        cafes:[],
        hospitales:[],
        hoteles:[],
        establecimiento:{},
        establecimientos:[],
        categorias:[],
        categoria:'',
    },
    mutations:{
        CARGAR_CAFES(state, cafes) {
            state.cafes = cafes;
        },
        CARGAR_HOSPITALES(state, hospitales) {
            state.hospitales = hospitales;
        },
        CARGAR_HOTELES(state, hoteles) {
            state.hoteles = hoteles;
        },
        CARGAR_ESTABLECIMIENTO(state, establecimiento) {
            state.establecimiento = establecimiento;
        },
        CARGAR_ESTABLECIMIENTOS(state, establecimientos) {
            state.establecimientos = establecimientos;
        },
        CARGAR_CATEGORIAS(state, categorias) {
            state.categorias = categorias;
        },
        SELECCIONAR_CATEGORIA(state, categoria) {
            state.categoria = categoria;
        }
    },
    getters:{
        getEstablecimiento:state=>{
            return state.establecimiento;
        },
        getEstablecimientos:state=>{
            return state.establecimientos;
        },
        getImagenes:state=>{
            return state.establecimiento.imagenes;
        },
        getCategorias:state=>{
            return state.categorias;
        },
        getCategoria:state=>{
            return state.categoria;
        }
    }
});
