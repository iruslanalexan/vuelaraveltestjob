require('./bootstrap');

import Vuesax from 'vuesax';
import 'vuesax/dist/vuesax.css';

import Vue from 'vue';
import VueRouter from 'vue-router';
import router from './src/Router.js';
import App from './components/App.vue';

import BootstrapVue from 'bootstrap-vue'
import vSelect from 'vue-select'

Vue.component('v-select', vSelect)

Vue.use(BootstrapVue)
Vue.use(VueRouter)
Vue.use(Vuesax)

const req = require.context('./components/', true, /\.(js|vue)$/i);
req.keys().map(key => {
  const name = key.match(/\w+/)[0];
  return Vue.component(name, req(key).default)
});

new Vue({
    el: '#app',
    router,
    template: '<App/>',
    components: { App }
})