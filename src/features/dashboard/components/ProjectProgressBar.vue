<template>
  <div>
    <div class="flex items-center justify-between mb-2">
      <span class="font-medium text-gray-700 text-sm">{{ project.name }}</span>
      <span class="text-xs font-bold text-gray-600">{{ project.completion }}%</span>
    </div>
    <div class="w-full bg-gray-200 rounded-full h-2">
      <div :class="[project.color, 'h-2 rounded-full transition-all']" :style="{ width: project.completion + '%' }"></div>
    </div>
  </div>
</template>

<script setup>
defineProps({
  project: Object
})
</script>

<style scoped></style>
