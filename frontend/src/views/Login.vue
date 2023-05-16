<script setup>
import { onMounted, ref } from 'vue'
import Api from '../services/api'
import { useRouter } from 'vue-router'
import Alert from '../components/Alert.vue'

let user = ref({
    id_card_number: '',
    password: ''
})
const router = useRouter()
const first = ref(null)
const alertMsg = ref({
    type: '',
    text: ''
})

async function login(e) {
    const res = await new Api('/auth/login', 'POST', user.value).login()
    const data = await res.json()

    if (res.status == 200) {
        alertMsg.value.type = 'success'
        alertMsg.value.text = 'Login Success!'

        localStorage.setItem('isLogin', 'true')
        localStorage.setItem('token', data.token)
        localStorage.setItem('username', data.name)
        localStorage.setItem('region', data.regional.district)

        setTimeout(() => {
            router.push('/dashboard')
        }, 1000);
        
    } else {
        alertMsg.value.type = 'danger'
        if(typeof data.message == 'object') alertMsg.value.text = 'id_card_number and password input are required!'
        else alertMsg.value.text = data.message
        user.value = {
            id_card_number: '',
            password: ''
        }
        first.value.focus()
    }
}

onMounted(() => {
    if (localStorage.getItem('logoutstate')) {
        alertMsg.value.type = 'success'
        alertMsg.value.text = 'Logout Success!'
        setTimeout(() => {
            alertMsg.value = {
                type: '',
                text: ''
            }
            localStorage.removeItem('logoutstate')
        }, 1200);
    }

    first.value.focus()
})

</script>
<template>
    <div class="row justify-content-center">
        <div class="col-md-6">
          <Alert :type="alertMsg.type" :text="alertMsg.text" v-if="alertMsg.text" />
          <form class="card card-default" @submit.prevent="login" autocomplete="off">
              <div class="card-header">
                  <h4 class="mb-0">Login</h4>
              </div>
              <div class="card-body">
                  <div class="form-group row align-items-center">
                      <div class="col-4 text-right">ID Card Number</div>
                      <div class="col-8"><input type="text" class="form-control" ref="first" v-model="user.id_card_number" autofocus></div>
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