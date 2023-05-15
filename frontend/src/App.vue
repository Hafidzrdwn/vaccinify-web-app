<script setup>
import Navbar from './components/Navbar.vue'
import MainHeader from './components/MainHeader.vue'
</script>
<template>
<Navbar />
<main>
  <div v-if="this.$route.name != 'Vaccination Spots' && this.$route.name != 'Vaccination Spot Detail'
    ">
    <MainHeader :title="this.$route.meta.header" :name="this.$route.name" />
    <div class="container pb-5">
      <router-view></router-view>
    </div>
  </div>

  <div v-else>
    <router-view></router-view>
  </div>
</main>
</template>
