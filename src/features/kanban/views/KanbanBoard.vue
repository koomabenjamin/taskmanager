<template>
  <div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
      <div>
        <h1 class="text-3xl font-bold text-emerald-900">Kanban Board</h1>
        <p class="text-gray-600 mt-2">Organize your tasks by status with drag-and-drop</p>
      </div>
      <Button label="Add Column" icon="PlusIcon" variant="primary" />
    </div>

    <!-- Kanban Columns -->
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6 overflow-x-auto">
      <KanbanColumn
        v-for="column in kanbanColumns"
        :key="column.id"
        :column="column"
        :tasks="getTasksByStatus(column.id)"
      />
    </div>

    <!-- Advanced Features -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
      <!-- Filters & Search -->
      <div class="bg-white rounded-lg p-6 shadow-sm border border-emerald-100">
        <h3 class="text-lg font-bold text-emerald-900 mb-4">Filters</h3>
        <div class="space-y-3">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Assigned To</label>
            <select class="w-full px-3 py-2 border border-emerald-200 rounded-lg">
              <option>All Members</option>
              <option>John Doe</option>
              <option>Jane Smith</option>
              <option>Mike Johnson</option>
            </select>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Priority</label>
            <div class="flex space-x-2">
              <button class="px-3 py-2 rounded-lg bg-red-100 text-red-700 font-semibold text-sm">High</button>
              <button class="px-3 py-2 rounded-lg bg-yellow-100 text-yellow-700 font-semibold text-sm">Medium</button>
              <button class="px-3 py-2 rounded-lg bg-blue-100 text-blue-700 font-semibold text-sm">Low</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Board Statistics -->
      <div class="bg-white rounded-lg p-6 shadow-sm border border-emerald-100">
        <h3 class="text-lg font-bold text-emerald-900 mb-4">Statistics</h3>
        <div class="space-y-3">
          <div class="flex justify-between items-center">
            <span class="text-gray-700">Total Tasks</span>
            <span class="font-bold text-lg text-emerald-700">{{ totalTasks }}</span>
          </div>
          <div class="flex justify-between items-center">
            <span class="text-gray-700">In Progress</span>
            <span class="font-bold text-lg text-blue-700">{{ inProgressCount }}</span>
          </div>
          <div class="flex justify-between items-center">
            <span class="text-gray-700">Completed</span>
            <span class="font-bold text-lg text-green-700">{{ completedCount }}</span>
          </div>
          <div class="flex justify-between items-center">
            <span class="text-gray-700">Blocked</span>
            <span class="font-bold text-lg text-red-700">{{ blockedCount }}</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import Button from '@/features/shared/components/Button.vue'
import KanbanColumn from '../components/KanbanColumn.vue'

const kanbanColumns = ref([
  { id: 'backlog', name: 'Backlog', color: 'bg-gray-100' },
  { id: 'todo', name: 'To Do', color: 'bg-blue-100' },
  { id: 'in-progress', name: 'In Progress', color: 'bg-yellow-100' },
  { id: 'done', name: 'Done', color: 'bg-green-100' }
])

const allTasks = ref([
  { id: 1, title: 'A/B Testing - Round 3', status: 'in-progress', priority: 'high', assignees: ['John Doe'], tags: ['Testing', 'Research'] },
  { id: 2, title: 'Design System Documentation', status: 'todo', priority: 'medium', assignees: ['Jane Smith'], tags: ['Documentation'] },
  { id: 3, title: 'User Research Analysis', status: 'in-progress', priority: 'high', assignees: ['Mike Johnson'], tags: ['Research'] },
  { id: 4, title: 'API Integration', status: 'backlog', priority: 'medium', assignees: ['John Doe', 'Sarah Williams'], tags: ['Backend'] },
  { id: 5, title: 'Performance Optimization', status: 'done', priority: 'low', assignees: ['Sarah Williams'], tags: ['Optimization'] },
  { id: 6, title: 'Bug Fixes', status: 'in-progress', priority: 'high', assignees: ['Mike Johnson'], tags: ['Bug'] },
  { id: 7, title: 'Feature Testing', status: 'todo', priority: 'medium', assignees: ['Jane Smith', 'John Doe'], tags: ['Testing'] },
  { id: 8, title: 'Database Migration', status: 'backlog', priority: 'high', assignees: ['Sarah Williams'], tags: ['Database'] }
])

const getTasksByStatus = (status) => {
  return allTasks.value.filter(task => task.status === status)
}

const totalTasks = computed(() => allTasks.value.length)
const inProgressCount = computed(() => getTasksByStatus('in-progress').length)
const completedCount = computed(() => getTasksByStatus('done').length)
const blockedCount = computed(() => allTasks.value.filter(t => t.priority === 'high').length)
</script>

<style scoped></style>
