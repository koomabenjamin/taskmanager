<template>
  <div class="bg-white rounded p-4 shadow border-l-2 border-emerald-600 text-center">
    <p class="text-2xl font-bold text-emerald-700">{{ hours }}</p>
    <p class="text-xs text-gray-600 mt-1">{{ title }}</p>
    <p class="text-xs text-gray-500">{{ unit }}</p>
  </div>
</template>

<script setup>
defineProps({
  title: String,
  hours: Number,
  unit: String
})
</script>

<style scoped></style>


