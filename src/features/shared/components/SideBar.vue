<template>
  <div :class="['w-64 h-full flex flex-col border-r shadow-sm', theme.tailwind.sidebar]">
    <!-- Logo & Brand -->
    <div class="p-6 border-b">
      <div :class="['flex items-center space-x-2', theme.tailwind.text]">
        <CheckCircleIcon class="w-8 h-8 text-emerald-700" />
        <span class="text-2xl font-bold">Task Master</span>
      </div>
    </div>

    <!-- Action Button -->
    <div class="px-6 py-4 border-b">
      <Button label="New Task" icon="PlusIcon" variant="primary" size="lg" @click="$emit('add-task')" />
    </div>

    <!-- Navigation Menu -->
    <div class="flex-1 overflow-auto px-4 py-6 space-y-2">
      <NavItem
        v-for="item in navItems"
        :key="item.id"
        :label="item.label"
        :icon="item.icon"
        :active="activeNav === item.id"
        @click="selectNav(item.id)"
      />
    </div>

    <!-- Collapsible Sections -->
    <div class="flex-1 overflow-auto px-4 space-y-4">
      <CollapsibleSection title="Projects" :items="projects" />
      <CollapsibleSection title="Tags" :items="tags" />
      <CollapsibleSection title="Team Members" :items="teamMembers" />
    </div>

    <!-- Plan Information -->
    <div :class="['p-6 border-t', theme.tailwind.border]">
      <div class="space-y-3">
        <div class="flex items-center justify-between">
          <span class="font-semibold text-sm text-gray-700">Free Plan</span>
          <span class="text-xs font-bold text-emerald-600">4/10</span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-2">
          <div class="bg-emerald-500 h-2 rounded-full" style="width: 40%"></div>
        </div>
        <p class="text-xs text-gray-500">4 out of 10 projects used</p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { useThemeStore } from '@/stores/themes/themeStore'
import { CheckCircleIcon } from '@heroicons/vue/24/outline'
import Button from './Button.vue'
import NavItem from './NavItem.vue'
import CollapsibleSection from './CollapsibleSection.vue'

const emit = defineEmits(['add-task', 'nav-change'])

const themeStore = useThemeStore()
const theme = computed(() => themeStore.activeTheme)

const activeNav = ref('dashboard')

const navItems = [
  { id: 'dashboard', label: 'Dashboard', icon: 'ViewGridIcon' },
  { id: 'kanban', label: 'Kanban Board', icon: 'WindowIcon' },
  { id: 'priority', label: 'Priority Chart', icon: 'ChartBarIcon' },
  { id: 'backlog', label: 'Backlog', icon: 'QueueListIcon' },
  { id: 'timeTracking', label: 'Time Tracking', icon: 'ClockIcon' },
  { id: 'analytics', label: 'Analytics', icon: 'SparklesIcon' },
  { id: 'team', label: 'Team', icon: 'UserGroupIcon' }
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

const selectNav = (id) => {
  activeNav.value = id
  emit('nav-change', id)
}
</script>

<style scoped></style>
