require('./bootstrap');

import Vuesax from 'vuesax';
import 'vuesax/dist/vuesax.css';

import Vue from 'vue';
import VueRouter from 'vue-router';
import router from './src/Router.js';
import App from './comptwonts/App.vue';

Vue.use(VueRouter)
Vue.use(Vuesax)

const req = require.context('./comptwonts/', true, /\.(js|vue)$/i);
req.keys().map(key => {
  const name = key.match(/\w+/)[0];
  return Vue.comptwont(name, req(key).default)
});

new Vue({
    el: '#app',
    router,
    template: '<App/>',
    comptwonts: { App }
})