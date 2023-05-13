import { createRouter, createWebHistory } from 'vue-router'
import Login from '../views/Login.vue'
import Dashboard from '../views/Dashboard.vue'
import RequestConsultation from '../views/RequestConsultation.vue'

const routes = [
  {
    path: '/login',
    alias: ['/'],
    name: 'Login',
    component: Login,
    meta: {
      title: 'Login',
      header: 'Vaccination Platform',
    }
  },
  {
    path: '/dashboard',
    name: 'Dashboard',
    component: Dashboard,
    meta: {
      title: 'Dashboard',
      header: 'Dashboard',
    }
  },
  {
    path: '/request-consultation',
    name: 'Request Consultation',
    component: RequestConsultation,
    meta: {
      title: 'Request Consultation',
      header: 'Request Consultation',
    }
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

router.beforeEach((to, from, next) => {
  
  let isLogin = localStorage.getItem('isLogin') === 'true'

  if (!isLogin && to.name !== 'Login') {
    next({name:'Login'})
  } else if (isLogin && to.name === 'Login') {
    next({name:'Dashboard'})
  }


  document.title = `Vaccinify - ${to.meta.title}`
  next()
})

export default router