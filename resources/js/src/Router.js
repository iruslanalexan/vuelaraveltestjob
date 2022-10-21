import VueRouter from 'vue-router'
import Vue from 'vue'
import CarListComponent from '../components/CarListComponent.vue'
import CreateForm from '../components/CreateForm.vue'
import EditForm from '../components/EditForm.vue'

Vue.use(VueRouter)

export default new VueRouter({
  mode : 'history',
  routes: [
    {
      path: '/',
      name: 'list',
      component: CarListComponent
    },
    {
      path: '/create',
      name: 'create',
      component: CreateForm
    },
    {
      path: '/edit',
      name: 'edit',
      component: EditForm
    }
  ]
})
