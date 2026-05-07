<template>
  <div :class="['rounded-lg border-2 p-4 shadow-sm transition-all duration-200 hover:shadow-md', theme.tailwind.border, theme.tailwind.bg]">
    <slot></slot>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import { useThemeStore } from '@/stores/themes/themeStore'

const themeStore = useThemeStore()
const theme = computed(() => themeStore.activeTheme)
</script>

<style scoped></style>
