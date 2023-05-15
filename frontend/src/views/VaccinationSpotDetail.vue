<script setup>
import Api from '../services/api'
import { ref, onBeforeMount } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import Alert from '../components/Alert.vue'

const route = useRoute()
const router = useRouter()
const token = localStorage.getItem('token')
const isLoading = ref(false)
const loadingSpot = ref(false)
const loadingReq = ref(false)

const spot = ref('')
const date = ref(new Date().toISOString().slice(0, 10))
const spot_id = ref(route.params.id)

const getDetailSpot = async () => {
  loadingSpot.value = true
  const res = await new Api(`/spots/${spot_id.value}?token=${token}&date=${date.value}`, 'GET').getDetailSpot()
  const data = await res.json()

  if (res.status == 200) {
    isLoading.value = false
    loadingSpot.value = false
    spot.value = data
  } else {
    alert(data.message)
  }
}

const stateMsg = ref({
  type: '',
  text: ''
})

const requestVaccination = async () => {
  loadingReq.value = true
  const res = await new Api(`/vaccinations?token=${token}`, 'POST', { date: date.value, spot_id: spot_id.value }).requestVaccination()
  const data = await res.json()

  if (res.status == 200) {
    loadingReq.value = false
    stateMsg.value.type = 'success'
    stateMsg.value.text = data.message
  } else {
    stateMsg.value.type = 'danger'
    stateMsg.value.text = data.message
  }

  setTimeout(() => {
    router.push('/dashboard')
  }, 2000);
}

onBeforeMount(async () => {
  isLoading.value = true
  await getDetailSpot()
})
</script>
<template>

  <!-- S: Header -->
    <header class="jumbotron">
        <div class="container d-flex justify-content-between align-items-center" v-if="!isLoading">
            <div v-if="spot.spot">
                <h1 class="display-4">{{ spot.spot.name }}</h1>
                <span class="text-muted">{{ spot.spot.address }}</span>
            </div>
            <a href="" class="btn btn-primary" @click.prevent="requestVaccination">
              <span v-if="!loadingReq">Register vaccination</span>
              <span v-else>Loading...</span>
            </a>
        </div>
    </header>
  <!-- E: Header -->

  <div class="container" v-if="!loadingSpot">
          <Alert :text="stateMsg.text" :type="stateMsg.type" />
          <div class="row mb-3">
              <div class="col-md-3">
                  <div class="form-group">
                      <label for="vaccination-date">Select vaccination date</label>
                      <input type="date" class="form-control" v-model="date" id="vaccination-date" @input.prevent="getDetailSpot">
                  </div>
              </div>
          </div>

          <div class="row mb-5">

              <!-- S: Session 1 -->
              <div class="col-md-4" v-if="spot.spot.capacity > 0">
                  <div class="card card-default">
                      <div class="card-body">
                          <div class="d-flex align-items-center justify-content-between mb-3">
                              <h4>Session 1</h4>
                              <span class="text-muted">09:00 - 11:00</span>
                          </div>
                          <div>
                              <div class="row">
                                  <div class="col-4 mb-4" v-for="(n, idx) in [1,2,3,4,5]" :key="idx">
                                      <div class="slot" :class="{'filled' : n <= spot.vaccinations_count, 'bg-primary text-white' : n == spot.vaccinations_count + 1 }"> #{{ n }} </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <!-- E: Session 1 -->

              <!-- S: Session 2 -->
              <div class="col-md-4" v-if="spot.spot.capacity > 5">
                  <div class="card card-default">
                      <div class="card-body">
                          <div class="d-flex align-items-center justify-content-between mb-3">
                              <h4>Session 2</h4>
                              <span class="text-muted">13:00 - 15:00</span>
                          </div>
                          <div>
                              <div class="row">
                                <div class="col-4 mb-4" v-for="(n, idx) in [6, 7, 8, 9, 10]" :key="idx">
                                  <div class="slot" :class="{ 'filled': n <= spot.vaccinations_count }"> #{{ n }} </div>
                                </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <!-- E: Session 2 -->

              <!-- S: Session 3 -->
              <div class="col-md-4" v-if="spot.spot.capacity > 10">
                  <div class="card card-default">
                      <div class="card-body">
                          <div class="d-flex align-items-center justify-content-between mb-3">
                              <h4>Session 3</h4>
                              <span class="text-muted">15:00 - 17:00</span>
                          </div>
                          <div>
                              <div class="row">
                                  <div class="col-4 mb-4" v-for="(n, idx) in [11, 12, 13, 14, 15]" :key="idx">
                                    <div class="slot" :class="{ 'filled': n <= spot.vaccinations_count }"> #{{ n }} </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <!-- E: Session 3 -->

          </div>

      </div>
      <h3 class="text-center mt-5" v-if="!isLoading && loadingSpot">
        Loading spot...
      </h3>
      <h3 class="text-center mt-5" v-if="isLoading">
        Loading data...
      </h3>

</template>