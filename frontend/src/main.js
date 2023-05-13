import { createApp } from 'vue'
import App from './App.vue'
import './assets/css/bootstrap.css'
import './style.css'
import './assets/css/custom.css'

import router from './router'
window.base = (url) => {
  return `http://localhost:9000/api/v1${url}`
}

createApp(App)
  .use(router)  
  .mount('#app')
