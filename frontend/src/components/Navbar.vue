<script setup>
import { watch, ref } from 'vue';
import { useRouter, useRoute } from 'vue-router'
import Api from '../services/api'

const isLogin = ref(localStorage.getItem('isLogin') == 'true')
const username = ref('')

const router = useRouter()
const route = useRoute()

watch([() => route.path, isLogin], (newValue, oldValue) => {
    if (!localStorage.getItem('token') && newValue[1] == true) {
        isLogin.value = false
    } else if (localStorage.getItem('token') && !newValue[1] || newValue[1]) {
        isLogin.value = true
        username.value = localStorage.getItem('username')
    } 
}, { immediate: true })

async function logout() {
    if (confirm('Are you sure you want to logout??')) {
        const res = await new Api(`/auth/logout?token=${localStorage.getItem('token')}`, 'POST').logout()
        const data = await res.json()
        
        if (res.status == 200) {
            localStorage.setItem('isLogin', 'false')
            localStorage.removeItem('username')
            localStorage.removeItem('region')
            localStorage.removeItem('token')

            localStorage.setItem('logoutstate', true)
            router.push('/login')
        } else {
            alert(data.message)
        }
    }
}
</script>
<template>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-primary">
      <div class="container">
          <span class="navbar-brand">Vaccination Platform</span>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav ml-auto" v-if="!isLogin">
                <li class="nav-item">
                    <router-link to="/login" class="nav-link" :class="{ 'active' : this.$route.path == '/login'}">Login</router-link>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto" v-if="isLogin">
                <li class="nav-item">
                    <router-link class="nav-link active" to="/dashboard">{{ username }}</router-link>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" @click.prevent="logout">Logout</a>
                </li>
            </ul>
        </div>
      </div>
  </nav>
</template>