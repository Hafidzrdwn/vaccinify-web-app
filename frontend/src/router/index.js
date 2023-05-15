import { createRouter, createWebHistory } from 'vue-router'
import Login from '../views/Login.vue'
import Dashboard from '../views/Dashboard.vue'
import RequestConsultation from '../views/RequestConsultation.vue'
import VaccinationSpots from '../views/VaccinationSpots.vue'
import VaccinationSpotDetail from '../views/VaccinationSpotDetail.vue'

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
  {
    path: '/vaccination-spots/:dose',
    name: 'Vaccination Spots',
    component: VaccinationSpots,
    meta: {
      title: 'Vaccination Spots'
    }
  },
  {
    path: '/vaccination-spots/:id/detail',
    name: 'Vaccination Spot Detail',
    component: VaccinationSpotDetail,
    meta: {
      title: 'Vaccination Spot Detail'
    }
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

router.beforeEach((to, from, next) => {
  window.scrollTo(0,0)
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