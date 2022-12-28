import Vue from 'vue'
import VueRouter from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LoginView from "@/views/LoginView";
import OverView from "@/views/OverView";
import TransactionsView from "@/views/TransactionsView";

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/login',
    name: 'login',
    component: LoginView
  },
  {
    path: '/overview',
    name: 'overview',
    component: OverView
  },
  {
    path: '/transactions',
    name: 'transactions',
    component: TransactionsView
  }
]

const router = new VueRouter({
  routes
})

export default router
