import { createRouter, createWebHistory } from 'vue-router'
import LoginPage from '../../views/auth/LoginPage.vue'
import RegisterPage from '../../views/auth/RegisterPage.vue'
import HomePage from '../../views/auth/Module_1/HomePage.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/login', component: LoginPage
    },
    {
      path: '/register', component: RegisterPage
    },
    {
      path: '/home', component: HomePage, name: 'home'
    }
  ],
})

export default router
