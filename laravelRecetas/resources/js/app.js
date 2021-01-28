/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import VueSweetalert2 from 'vue-sweetalert2';
import 'owl.carousel';
require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// la siguiente linea es para agregar plugin a vue js
Vue.use(VueSweetalert2);
Vue.config.ignoredElements = ['trix-editor','trix-toolbar'];
Vue.component('fecha-receta', require('./components/FechaRecetaComponent.vue').default);
Vue.component('eliminar-receta', require('./components/EliminarRecetaComponent.vue').default);
Vue.component('like-button', require('./components/LikeButtonComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});


/**carrusel */
// en webpack.mix.js se coloco el jquery
jQuery(document).ready(function(){
    jQuery('.owl-carousel').owlCarousel({
        margin: 10,
        loop: true,
        autoplay:true,
        autoplayHoverPause:true,
        responsiveClass:true,
        responsive: {
            0:{
                items:1
            },
            600:{
                items: 2
            },
            1000:{
                items: 3
            }
        }
    });
});