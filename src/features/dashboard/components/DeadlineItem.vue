<template>
  <div class="p-3 rounded border border-red-200 bg-red-50 hover:bg-red-100 transition-all">
    <div class="flex items-start justify-between">
      <div>
        <p class="font-medium text-gray-800">{{ deadline.title }}</p>
        <p class="text-xs text-gray-600 mt-1">{{ deadline.project }}</p>
      </div>
      <div :class="['text-sm font-bold', daysLeftClass]">
        {{ deadline.daysLeft }}d
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  deadline: Object
})

const daysLeftClass = computed(() => {
  if (props.deadline.daysLeft <= 1) return 'text-red-700'
  if (props.deadline.daysLeft <= 3) return 'text-yellow-700'
  return 'text-emerald-700'
})
</script>

<style scoped></style>


