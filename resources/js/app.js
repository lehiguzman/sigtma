/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('usuario', require('./components/Usuario.vue').default);
Vue.component('tipo_comercio', require('./components/Tipo_comercio.vue').default);
Vue.component('tipo_inmueble', require('./components/Tipo_inmueble.vue').default);
Vue.component('tipo_vehiculo', require('./components/Tipo_vehiculo.vue').default);
Vue.component('comercio', require('./components/Comercio.vue').default);
Vue.component('inmueble', require('./components/Inmueble.vue').default);
Vue.component('vehiculo', require('./components/Vehiculo.vue').default);
Vue.component('pago_comercio', require('./components/Pago_comercio.vue').default);
Vue.component('periodo', require('./components/Periodo.vue').default);
Vue.component('zona', require('./components/Zona.vue').default);
Vue.component('regimen', require('./components/Regimen.vue').default);
Vue.component('calculo_comercio', require('./components/Calculo_comercio.vue').default);
Vue.component('calculo_inmueble', require('./components/Calculo_inmueble.vue').default);
Vue.component('calculo_vehiculo', require('./components/Calculo_vehiculo.vue').default);

Vue.component('pago_comercio', require('./components/Pago_comercio.vue').default);
//Vue.component('pago_inmueble', require('./components/Pago_inmueble.vue').default);
//Vue.component('pago_vehiculo', require('./components/Pago_vehiculo.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data: {
    	menu:0,    	
    },
});