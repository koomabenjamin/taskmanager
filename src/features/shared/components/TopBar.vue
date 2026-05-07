<template>
  <div :class="['w-full px-6 py-4 shadow-sm', theme.tailwind.header]">
    <div class="flex items-center justify-between">
      <div class="flex items-center space-x-4">
        <input
          type="text"
          placeholder="Search tasks, projects, or members..."
          :class="['px-4 py-2 rounded-lg border-2 w-80', theme.tailwind.border, 'focus:outline-none', theme.tailwind.focus]"
        />
      </div>

      <div class="flex items-center space-x-4">
        <!-- Theme Toggle -->
        <div class="flex items-center space-x-2">
          <button
            @click="toggleTheme"
            :class="['p-2 rounded-lg transition-all duration-200', 'hover:bg-emerald-100']"
            title="Toggle Theme"
          >
            <SwatchIcon class="w-5 h-5 text-emerald-700" />
          </button>
          <div class="flex space-x-1">
            <button
              v-for="t in themeStore.themes"
              :key="t.name"
              @click="themeStore.setTheme(t.name)"
              :class="[
                'w-4 h-4 rounded-full transition-all duration-200 border-2',
                themeStore.currentTheme === t.name ? 'ring-2 ring-offset-2 ring-emerald-700' : '',
                getThemeColor(t.name)
              ]"
              :title="t.label"
            />
          </div>
        </div>

        <!-- Notifications -->
        <button class="p-2 rounded-lg hover:bg-gray-100 transition-all duration-200 relative">
          <BellIcon class="w-5 h-5 text-gray-600" />
          <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
        </button>

        <!-- User Profile -->
        <button class="flex items-center space-x-2 hover:bg-gray-100 px-3 py-2 rounded-lg transition-all duration-200">
          <div class="w-8 h-8 rounded-full bg-gradient-to-br from-emerald-600 to-emerald-800"></div>
          <span class="text-sm font-semibold text-gray-700">Profile</span>
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import { useThemeStore } from '@/stores/themes/themeStore'
import { SwatchIcon, BellIcon } from '@heroicons/vue/24/outline'

const themeStore = useThemeStore()
const theme = computed(() => themeStore.activeTheme)

const toggleTheme = () => {
  themeStore.toggleTheme()
}

const getThemeColor = (themeName) => {
  const colors = {
    deepForest: 'bg-emerald-600',
    ocean: 'bg-blue-600',
    purple: 'bg-purple-600',
    slate: 'bg-slate-600'
  }
  return colors[themeName]
}
</script>

<style scoped></style>
