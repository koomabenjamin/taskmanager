<template>
  <button
    @click="$emit('click')"
    :class="[
      'w-full px-4 py-3 rounded flex items-center justify-center transition-all duration-200',
      active
        ? 'bg-emerald-100 text-emerald-700 font-semibold'
        : 'text-gray-700 hover:bg-gray-100'
    ]"
    :title="label"
  >
    <div v-if="!collapsed" class="flex items-center space-x-3 w-full justify-start">
      <component :is="getIcon(icon)" class="w-5 h-5 flex-shrink-0" />
      <span>{{ label }}</span>
    </div>
    <component v-else :is="getIcon(icon)" class="w-5 h-5" />
  </button>
</template>

<script setup>
import * as HeroIcons from '@heroicons/vue/24/outline'

defineProps({
  label: String,
  icon: String,
  active: Boolean,
  collapsed: Boolean
})

defineEmits(['click'])

const getIcon = (iconName) => {
  return HeroIcons[iconName]
}
</script>

<style scoped></style>


