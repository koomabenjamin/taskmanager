<template>
  <div class="bg-white rounded p-4 shadow border-l-2 border-emerald-600">
    <p class="font-medium text-gray-800">{{ entry.task }}</p>
    <div class="flex items-center justify-between mt-2">
      <span class="text-xs text-gray-600">{{ entry.project }}</span>
      <span class="font-bold text-emerald-700">{{ entry.duration }}</span>
    </div>
  </div>
</template>

<script setup>
defineProps({
  entry: Object
})
</script>

<style scoped></style>


