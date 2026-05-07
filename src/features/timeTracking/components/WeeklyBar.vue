<template>
  <div class="text-center">
    <div class="bg-gradient-to-t from-emerald-500 to-emerald-300 rounded-lg p-2 h-24 flex items-end justify-center" :style="{ height: (hours / 8) * 100 + 'px' || '20px' }"></div>
    <p class="text-xs font-semibold text-gray-700 mt-2">{{ day }}</p>
    <p class="text-xs text-gray-600">{{ hours }}h</p>
  </div>
</template>

<script setup>
defineProps({
  day: String,
  hours: Number
})
</script>

<style scoped></style>
