<template>
  <button
    @click="$emit('click')"
    :class="[
      'w-full px-4 py-3 rounded-lg flex items-center justify-between transition-all duration-200',
      active
        ? 'bg-emerald-100 text-emerald-700 font-semibold'
        : 'text-gray-700 hover:bg-gray-100'
    ]"
  >
    <div class="flex items-center space-x-3">
      <component :is="getIcon(icon)" class="w-5 h-5" />
      <span>{{ label }}</span>
    </div>
  </button>
</template>

<script setup>
import * as HeroIcons from '@heroicons/vue/24/outline'

defineProps({
  label: String,
  icon: String,
  active: Boolean
})

defineEmits(['click'])

const getIcon = (iconName) => {
  return HeroIcons[iconName]
}
</script>

<style scoped></style>
