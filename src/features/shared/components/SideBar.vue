<template>
  <div :class="['h-full flex flex-col border-r shadow transition-all duration-300', 
    isCollapsed ? 'w-20' : 'w-80', 
    'border-gray-200 bg-white']">
    <!-- Logo & Brand -->
    <div :class="['p-6 border-b', 'border-gray-200']">
      <div v-if="!isCollapsed" :class="['flex items-center space-x-2', 'text-emerald-900']">
        <CheckCircleIcon class="w-8 h-8 text-emerald-700" />
        <span class="text-2xl font-bold">Task Master</span>
      </div>
      <div v-else class="flex justify-center">
        <CheckCircleIcon class="w-8 h-8 text-emerald-700" />
      </div>
    </div>

    <!-- Action Button -->
    <div :class="['px-6 py-4 border-b', 'border-gray-200']">
      <Button v-if="!isCollapsed" label="New Task" icon="PlusIcon" variant="primary" size="lg" @click="$emit('add-task')" />
      <button v-else @click="$emit('add-task')" class="w-full p-2 bg-emerald-700 text-white rounded hover:bg-emerald-800 transition-all">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
      </button>
    </div>

    <!-- Navigation Menu -->
    <div class="flex-1 overflow-auto px-4 py-6 space-y-2">
      <NavItem
        v-for="item in navItems"
        :key="item.id"
        :label="item.label"
        :icon="item.icon"
        :active="activeNav === item.id"
        :collapsed="isCollapsed"
        @click="navigateTo(item.routeName)"
      />
    </div>

    <!-- Collapsible Sections -->
    <div v-if="!isCollapsed" class="flex-1 overflow-auto px-4 space-y-4">
      <CollapsibleSection title="Projects" :items="projects" />
      <CollapsibleSection title="Tags" :items="tags" />
      <CollapsibleSection title="Team Members" :items="teamMembers" />
    </div>

    <!-- Plan Information -->
    <!-- Plan Information -->
    <div :class="['p-6 border-t', 'border-gray-200']">
      <div v-if="!isCollapsed" class="space-y-3">
        <div class="flex items-center justify-between">
          <span class="font-semibold text-sm text-gray-700">Free Plan</span>
          <span class="text-xs font-bold text-emerald-600">4/10</span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-2">
          <div class="bg-emerald-500 h-2 rounded-full" style="width: 40%"></div>
        </div>
        <p class="text-xs text-gray-500">4 out of 10 projects used</p>
      </div>
      <div v-else class="flex justify-center">
        <span class="text-xs font-bold text-emerald-600">4/10</span>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import { CheckCircleIcon } from '@heroicons/vue/24/outline'
import Button from './Button.vue'
import NavItem from './NavItem.vue'
import CollapsibleSection from './CollapsibleSection.vue'

const emit = defineEmits(['add-task', 'toggle-sidebar'])
const router = useRouter()
const route = useRoute()

const isCollapsed = ref(false)

// Map route names to nav item IDs
const routeToNavMap = {
  'dashboard': 'dashboard',
  'kanban': 'kanban',
  'priority': 'priority',
  'backlog': 'backlog',
  'timeTracking': 'timeTracking',
  'analytics': 'analytics',
  'team': 'team'
}

// Determine active nav based on current route
const activeNav = computed(() => {
  return routeToNavMap[route.name] || 'dashboard'
})

const toggleSidebar = () => {
  isCollapsed.value = !isCollapsed.value
  emit('toggle-sidebar', isCollapsed.value)
}

const navItems = [
  { id: 'dashboard', label: 'Dashboard', icon: 'ViewGridIcon', routeName: 'dashboard' },
  { id: 'kanban', label: 'Kanban Board', icon: 'WindowIcon', routeName: 'kanban' },
  { id: 'priority', label: 'Priority Chart', icon: 'ChartBarIcon', routeName: 'priority' },
  { id: 'backlog', label: 'Backlog', icon: 'QueueListIcon', routeName: 'backlog' },
  { id: 'timeTracking', label: 'Time Tracking', icon: 'ClockIcon', routeName: 'timeTracking' },
  { id: 'analytics', label: 'Analytics', icon: 'SparklesIcon', routeName: 'analytics' },
  { id: 'team', label: 'Team', icon: 'UserGroupIcon', routeName: 'team' }
]

const projects = [
  { id: 1, name: 'Statra Insurance', color: 'bg-emerald-600' },
  { id: 2, name: 'Meridian', color: 'bg-rose-600' },
  { id: 3, name: 'Risen', color: 'bg-blue-600' },
  { id: 4, name: 'SkillBox', color: 'bg-yellow-400' }
]

const tags = [
  { id: 1, name: 'Prototype', color: 'bg-purple-600' },
  { id: 2, name: 'Research', color: 'bg-emerald-600' },
  { id: 3, name: 'Testing', color: 'bg-yellow-400' }
]

const teamMembers = [
  { id: 1, name: 'John Doe', role: 'Lead Developer' },
  { id: 2, name: 'Jane Smith', role: 'Designer' },
  { id: 3, name: 'Mike Johnson', role: 'QA Engineer' },
  { id: 4, name: 'Sarah Williams', role: 'Product Manager' }
]

const navigateTo = (routeName) => {
  router.push({ name: routeName })
}
</script>

<style scoped></style>


