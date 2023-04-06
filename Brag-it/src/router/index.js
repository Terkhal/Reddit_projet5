import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/View_home.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
    },

  ]
})

export default router
