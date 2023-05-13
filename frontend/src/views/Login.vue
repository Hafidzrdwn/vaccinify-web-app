<script setup>
import { ref } from '@vue/reactivity'
import Api from '../services/api'
import {useRouter} from 'vue-router'

let user = ref({
    id_card_number: '',
    password: ''
})
const router = useRouter()

async function login(e) {
    const res = await new Api('/auth/login', 'POST', user.value).login()
    const data = await res.json()

    if (res.status == 200) {
        alert('Login Success!!')
        localStorage.setItem('isLogin', 'true')
        localStorage.setItem('token', data.token)
        localStorage.setItem('username', data.name)

        router.push('/dashboard')
        
    } else {
        alert(data.message)
        e.target.reset()
    }
}

</script>
<template>
  <div class="row justify-content-center">
      <div class="col-md-6">
          <form class="card card-default" @submit.prevent="login" autocomplete="off">
              <div class="card-header">
                  <h4 class="mb-0">Login</h4>
              </div>
              <div class="card-body">
                  <div class="form-group row align-items-center">
                      <div class="col-4 text-right">ID Card Number</div>
                      <div class="col-8"><input type="text" class="form-control" v-model="user.id_card_number"></div>
                  </div>
                  <div class="form-group row align-items-center">
                      <div class="col-4 text-right">Password</div>
                      <div class="col-8"><input type="password" class="form-control" v-model="user.password"></div>
                  </div>
                  <div class="form-group row align-items-center mt-4">
                      <div class="col-4"></div>
                      <div class="col-8"><button class="btn btn-primary">Login</button></div>
                  </div>
              </div>
          </form>
      </div>
  </div>
</template>