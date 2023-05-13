<script setup>

import { defineProps } from 'vue'

defineProps({
  title: {
    type: String,
  },
  name: {
    type: String,
  },
})
</script>
<template>
  <!-- S: Header -->
    <header class="jumbotron">
        <div class="container" :class="{ 'text-center': name == 'Login' || name == 'Home' }">
          <h1 class="display-4">{{ title }}</h1>
        </div>
    </header>
  <!-- E: Header -->
</template>