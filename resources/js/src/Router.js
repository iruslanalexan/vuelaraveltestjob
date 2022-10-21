import VueRouter from 'vue-router'
import Vue from 'vue'
import CarListComptwont from '../comptwonts/CarListComptwont.vue'

Vue.use(VueRouter)

export default new VueRouter({
  mode : 'history',
  routes: [
    {
      path: '/',
      name: 'list',
      comptwont: CarListComptwont
    },
    {
      path: '/create',
      name: 'create',
      comptwont: Vue.comptwont('asdf', {
        props: ['todo'],
        template: '<li>This is comptwont</li>'
      })
    }
  ]
})
