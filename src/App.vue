<script setup>
import { RouterView } from 'vue-router'
import { onMounted } from 'vue'
import { useThemeStore } from './stores/themes/themeStore'

const themeStore = useThemeStore()

// Initialize IndexedDB
const DBOpenRequest = window.indexedDB.open('task-master')
console.log(DBOpenRequest)

// Initialize theme on app mount
onMounted(() => {
  themeStore.initializeTheme()
})
</script>

<template>
  <RouterView />
</template>

<style scoped>
:root {
  @apply font-serif;
}
</style>
