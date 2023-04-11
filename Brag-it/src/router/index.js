import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/View_home.vue'
import singlePost from '../views/View_singlePost.vue'
import newPost from '../views/View_newPost.vue'
import category from '../views/View_category.vue'
import signup from '../views/View_signup.vue'
import admin from '../views/View_admin.vue'
import adminCrud from '../views/View_adminCrud.vue'
import profile from '../views/View_profile.vue'
import categVue from '../components/Comp_category_categoryPosts.vue';
 
 
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
    },
    {
      path: '/post/:post_id',
      name: 'singlePost',
      component: singlePost
    },
    {
      path: '/newpost',
      name: 'newPost',
      component: newPost
    },
    {
      path: '/category/:category_id',
      name: 'category',
      component: category,categVue
    },
    {
      path: '/sign_up',
      name: 'signup',
      component: signup
    },
    {
      path: '/admin',
      name: 'admin',
      component: admin
    },
    {
      path: '/admin/:crud',
      name: 'adminCrud',
      component: adminCrud
    },
    {
      path: '/user/:user_id',
      name: 'profile',
      component: profile
    }
  ]
})

export default router
