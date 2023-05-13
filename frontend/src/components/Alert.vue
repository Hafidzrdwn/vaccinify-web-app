<script setup>

import { defineProps } from 'vue'

defineProps({
  text: {
    type: String
  },
  type: {
    type: String
  }
})

</script>

<template>
  <div class="alert" :class="`alert-${type}`">
    {{ text }}
  </div>
</template>