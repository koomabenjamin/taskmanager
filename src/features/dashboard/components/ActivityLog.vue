<template>
  <div class="flex items-center space-x-3 pb-3 border-b border-gray-200 last:border-0">
    <div class="w-2 h-2 rounded-full bg-emerald-500 flex-shrink-0"></div>
    <div class="flex-1">
      <p class="text-sm text-gray-700">
        <span class="font-semibold">{{ activity.user }}</span>
        {{ activity.action }}
        <span class="text-emerald-700 font-medium">{{ activity.target }}</span>
      </p>
      <p class="text-xs text-gray-500 mt-0.5">{{ activity.time }}</p>
    </div>
  </div>
</template>

<script setup>
defineProps({
  activity: Object
})
</script>

<style scoped></style>


