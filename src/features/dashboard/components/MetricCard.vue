<template>
  <div :class="['px-4 py-2 rounded-lg bg-white shadow-sm border-l-4', borderColor]">
    <div class="flex items-center justify-between">
      <div class="flex items-start space-x-3 flex-1">
        <component :is="getIcon(icon)" :class="['w-6 h-6', textColor, 'flex-shrink-0']" />
        <div>
          <p class="text-sm text-gray-600 font-medium">{{ title }}</p>
          <p :class="[textColor, 'text-2xl font-bold']">{{ value }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import * as HeroIcons from '@heroicons/vue/24/outline'

defineProps({
  title: String,
  value: [String, Number],
  icon: String,
  color: String,
  textColor: String
})

const borderColor = computed(() => {
  return `border-emerald-500`
})

const getIcon = (iconName) => {
  return HeroIcons[iconName]
}

import { computed } from 'vue'
</script>

<style scoped></style>
