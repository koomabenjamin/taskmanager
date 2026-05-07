<template>
  <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg transition-all">
    <div class="flex-1">
      <p class="font-medium text-gray-800">{{ task.title }}</p>
      <div class="flex items-center space-x-2 mt-1 text-xs">
        <Tag :label="task.priority" :color="getPriorityColor(task.priority)" />
        <span class="text-gray-500">{{ formatDate(task.dueDate) }}</span>
      </div>
    </div>
    <div :class="['px-3 py-1 rounded-full text-xs font-semibold', getStatusColor(task.status)]">
      {{ task.status }}
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import Tag from '@/features/shared/components/Tag.vue'

const props = defineProps({
  task: Object
})

const getPriorityColor = (priority) => {
  const colors = { high: 'error', medium: 'warning', low: 'info' }
  return colors[priority] || 'info'
}

const getStatusColor = (status) => {
  const colors = {
    'in-progress': 'bg-blue-100 text-blue-700',
    pending: 'bg-yellow-100 text-yellow-700',
    completed: 'bg-green-100 text-green-700'
  }
  return colors[status] || 'bg-gray-100 text-gray-700'
}

const formatDate = (date) => {
  return new Date(date).toLocaleDateString('en-US', { month: 'short', day: 'numeric' })
}
</script>

<style scoped></style>
