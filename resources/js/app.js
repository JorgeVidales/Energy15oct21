/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

import Vuetify from 'vuetify'
Vue.use(Vuetify);
// PARA TRADUCIR VUETIFY 
import idioma from 'vuetify/lib'
Vue.use(idioma)
import mexico from 'vuetify/lib/locale/es'
// import pl from 'vuetify/src/locale/pl'
// import sv from './i18n/vuetify/sv'

// Grafias

import Vue from 'vue';

// import Highchart from "highcharts/highcharts";
// import HighchartsVue from "highcharts-vue";
// import stockInit from "highcharts/modules/stock";

// stockInit(Highchart);
// Vue.use(HighchartsVue);



Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('ejemplo', require('./components/ExampleComponent.vue').default);
Vue.component('card', require('./components/Card.vue').default);
Vue.component('cliente', require('./components/Cliente.vue').default);
Vue.component('cliente1', require('./components/Cliente1.vue').default);
Vue.component('estacion', require('./components/Estacion.vue').default);
Vue.component('maquina', require('./components/Maquina.vue').default);
Vue.component('aceite', require('./components/Aceite.vue').default);
Vue.component('reporte', require('./components/Reporte.vue').default);
Vue.component('reportegen', require('./components/ReporteGen.vue').default);
Vue.component('categoria', require('./components/Categoria.vue').default);
Vue.component('registro', require('./components/Registro.vue').default);
Vue.component('reportemaqueta', require('./components/ReporteMaqueta.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify({
        lang: {
            locales: { mexico},
            current: 'mexico',
          },
        }
    ),
    data :{
        menu : 0
    }
});
