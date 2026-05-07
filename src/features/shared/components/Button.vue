<template>
  <button
    :class="[
      'px-4 py-2 rounded-lg font-semibold transition-all duration-200 ease-in-out',
      'flex items-center space-x-2 justify-center',
      'hover:shadow-lg transform hover:scale-105',
      'focus:outline-none focus:ring-2 focus:ring-offset-2',
      variantClasses,
      sizeClasses,
      disabled ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer'
    ]"
    :disabled="disabled"
    @click="$emit('click')"
  >
    <component
      v-if="icon"
      :is="getIcon(icon)"
      :class="iconSizeClasses"
    />
    <span v-if="label">{{ label }}</span>
  </button>
</template>

<script setup>
import { computed } from 'vue'
import { useThemeStore } from '@/stores/themes/themeStore'
import * as HeroIcons from '@heroicons/vue/24/outline'

const props = defineProps({
  label: String,
  icon: String,
  variant: {
    type: String,
    default: 'primary' // primary, secondary, accent, ghost
  },
  size: {
    type: String,
    default: 'md' // sm, md, lg, xl
  },
  disabled: Boolean
})

const emit = defineEmits(['click'])

const themeStore = useThemeStore()
const theme = computed(() => themeStore.activeTheme)

const variantClasses = computed(() => {
  const variants = {
    primary: `${theme.value.tailwind.primary} text-white focus:ring-emerald-500`,
    secondary: `${theme.value.tailwind.secondary} text-white focus:ring-emerald-600`,
    accent: `${theme.value.tailwind.accent} text-white focus:ring-emerald-400`,
    ghost: `bg-transparent ${theme.value.tailwind.text} border-2 border-current hover:${theme.value.tailwind.bg}`
  }
  return variants[props.variant] || variants.primary
})

const sizeClasses = computed(() => {
  const sizes = {
    sm: 'text-sm px-3 py-1',
    md: 'text-base px-4 py-2',
    lg: 'text-lg px-5 py-3',
    xl: 'text-xl px-6 py-4'
  }
  return sizes[props.size] || sizes.md
})

const iconSizeClasses = computed(() => {
  const sizes = {
    sm: 'w-4 h-4',
    md: 'w-5 h-5',
    lg: 'w-6 h-6',
    xl: 'w-7 h-7'
  }
  return sizes[props.size] || sizes.md
})

const getIcon = (iconName) => {
  return HeroIcons[iconName]
}
</script>

<style scoped></style>
