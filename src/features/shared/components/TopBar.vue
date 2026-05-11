<template>
  <div class="w-full px-6 py-4 shadow border-b border-gray-200 bg-white">
    <div class="flex items-center justify-between">
      <div class="flex items-center space-x-4">
        <!-- Sidebar Toggle -->
        <button
          @click="$emit('toggle-sidebar')"
          class="p-2 rounded hover:bg-gray-100 transition-all duration-200"
          title="Toggle Sidebar"
        >
          <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
        
        <!-- Search -->
        <input
          type="text"
          placeholder="Search tasks, projects, or members..."
          class="px-4 py-2 rounded border border-gray-300 w-80 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-600"
        />
      </div>

      <div class="flex items-center space-x-4">
        <!-- Theme Toggle -->
        <div class="flex items-center space-x-2">
          <button
            @click="toggleTheme"
            class="p-2 rounded hover:bg-gray-100 transition-all duration-200"
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
                'w-4 h-4 rounded-full transition-all duration-200 border',
                themeStore.currentTheme === t.name ? 'ring-2 ring-offset-2 ring-emerald-700' : '',
                getThemeColor(t.name)
              ]"
              :title="t.label"
            />
          </div>
        </div>

        <!-- Notifications -->
        <button class="p-2 rounded hover:bg-gray-100 transition-all duration-200 relative">
          <BellIcon class="w-5 h-5 text-gray-600" />
          <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
        </button>

        <!-- User Profile -->
        <div class="relative">
          <button
            @click="showProfileMenu = !showProfileMenu"
            class="flex items-center space-x-2 hover:bg-gray-100 px-3 py-2 rounded transition-all duration-200"
          >
            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-emerald-600 to-emerald-800 flex items-center justify-center text-white text-xs font-bold">
              {{ getUserInitials() }}
            </div>
            <span class="text-sm font-semibold text-gray-700">{{ authStore.user?.name?.split(' ')[0] }}</span>
            <ChevronDownIcon class="w-4 h-4 text-gray-600" />
          </button>
          
          <!-- Dropdown Menu -->
          <div
            v-if="showProfileMenu"
            class="absolute right-0 mt-2 w-48 bg-white rounded shadow-lg border border-gray-200 z-50"
          >
            <div class="p-4 border-b border-gray-200">
              <p class="text-sm font-semibold text-gray-800">{{ authStore.user?.name }}</p>
              <p class="text-xs text-gray-600">{{ authStore.user?.email }}</p>
              <p class="text-xs text-emerald-700 font-bold mt-1">{{ getRoleName(authStore.user?.role) }}</p>
            </div>
            <div class="p-2 space-y-1">
              <router-link
                to="/profile"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded transition-all duration-200"
                @click="showProfileMenu = false"
              >
                My Profile
              </router-link>
              <router-link
                v-if="authStore.hasRole('admin')"
                to="/auth/authorization"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded transition-all duration-200"
                @click="showProfileMenu = false"
              >
                User Management
              </router-link>
              <button
                @click="handleLogout"
                class="w-full text-left px-4 py-2 text-sm text-red-700 hover:bg-red-50 rounded transition-all duration-200"
              >
                Logout
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed, ref } from 'vue'
import { useRouter } from 'vue-router'
import { useThemeStore } from '@/stores/themes/themeStore'
import { useAuthStore } from '@/stores/authStore'
import { SwatchIcon, BellIcon, ChevronDownIcon } from '@heroicons/vue/24/outline'

const themeStore = useThemeStore()
const authStore = useAuthStore()
const router = useRouter()
const theme = computed(() => themeStore.activeTheme)
const showProfileMenu = ref(false)

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

const getUserInitials = () => {
  if (!authStore.user?.name) return 'U'
  return authStore.user.name.split(' ').map(n => n[0]).join('').toUpperCase()
}

const getRoleName = (roleKey) => {
  return authStore.roles[roleKey]?.name || 'Unknown'
}

const handleLogout = () => {
  authStore.logout()
  showProfileMenu.value = false
  router.push('/auth/login')
}
</script>

<style scoped></style>


