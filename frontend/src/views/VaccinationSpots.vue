<script setup>
import Api from '../services/api'
import { ref, onBeforeMount } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const spots = ref('')
const token = localStorage.getItem('token')
const region = localStorage.getItem('region')
const isLoading = ref(false)
const available_vaccines = ref([])

const getSpots = async () => {
  isLoading.value = true
  const res = await new Api(`/spots?token=${token}`, 'GET').getSpots()
  const data = await res.json()

  if (res.status == 200) {
    isLoading.value = false
    spots.value = data.spots
    console.log(data.spots)
    data.spots.forEach((spot) => {
      const new_vaccines = Object.entries(spot.available_vaccines)
        .filter(([vaccine, available]) => available)
        .map(([vaccine]) => vaccine)
        .join(", ")

      available_vaccines.value.push(new_vaccines)
    })
    
  } else {
    alert(data.message)
  }
}

const detail = (id) => {
  router.push(`/vaccination-spots/${id}/detail`)
}

onBeforeMount(() => {
  getSpots()
})

</script>
<template>

  <!-- S: Header -->
  <header class="jumbotron">
      <div class="container">
          <h1 class="display-4">
            <span v-if="this.$route.params.dose == 1">First Vaccination</span>
            <span v-if="this.$route.params.dose == 2">Second Vaccination</span>
          </h1>
      </div>
  </header>
  <!-- E: Header -->

  <div class="container mb-5">

      <div class="section-header mb-4">
          <h4 class="section-title text-muted font-weight-normal">List Vaccination Spots in {{ region }}</h4>
      </div>

      <div class="section-body" v-if="!isLoading">

        <article class="spot" :class="{'unavailable': spot.unavailable}" v-for="(spot, idx) in spots" :key="spot.id" @click.prevent="detail(spot.id)">
              <div class="row">
                  <div class="col-5">
                      <h5 class="text-primary">{{ spot.name }}</h5>
                      <span class="text-muted">{{ spot.address }}</span>
                  </div>
                  <div class="col-4">
                      <h5>Available vaccines</h5>
                      <span class="text-muted">
                        {{ available_vaccines[idx] }}
                      </span>
                  </div>
                  <div class="col-3">
                      <h5>Serve</h5>
                      <span class="text-muted" v-if="spot.serve == 1">Only first vaccination</span>
                      <span class="text-muted" v-if="spot.serve == 2">Only second vaccination</span>
                      <span class="text-muted" v-if="spot.serve == 3">Both vaccination</span>
                  </div>
              </div>
          </article>
      </div>
      <h4 class="text-center" v-else>Loading...</h4>

  </div>

</template>