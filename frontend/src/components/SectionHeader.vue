<script setup>

import { defineProps } from 'vue'

defineProps({
  title: {
    type: String,
    required: true
  }
})
</script>
<template>
  <div class="section-header mb-3">
    <h4 class="section-title text-muted">{{ title }}</h4>
  </div>
</template>