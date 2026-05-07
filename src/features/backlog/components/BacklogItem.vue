<template>
  <div class="bg-white rounded-lg p-4 shadow-sm border-l-4 border-emerald-500 hover:shadow-md transition-all cursor-pointer">
    <div class="flex items-start justify-between">
      <div class="flex-1">
        <h4 class="font-semibold text-gray-800">{{ task.title }}</h4>
        <p class="text-sm text-gray-600 mt-1">{{ task.description }}</p>
        <div class="flex items-center space-x-3 mt-3">
          <Tag :label="task.priority" :color="getPriorityColor(task.priority)" />
          <span class="text-xs text-gray-600">Due: {{ formatDate(task.dueDate) }}</span>
          <span class="text-xs text-gray-600">{{ task.assignee }}</span>
        </div>
      </div>
      <span :class="['text-xs font-bold px-3 py-1 rounded-full', getStatusColor(task.status)]">
        {{ task.status }}
      </span>
    </div>
  </div>
</template>

<script setup>
import Tag from '@/features/shared/components/Tag.vue'

defineProps({
  task: Object
})

const getPriorityColor = (priority) => {
  const colors = { high: 'error', medium: 'warning', low: 'info' }
  return colors[priority] || 'info'
}

const getStatusColor = (status) => {
  const colors = {
    pending: 'bg-yellow-100 text-yellow-700',
    'in-review': 'bg-blue-100 text-blue-700',
    approved: 'bg-green-100 text-green-700'
  }
  return colors[status] || 'bg-gray-100 text-gray-700'
}

const formatDate = (date) => {
  return new Date(date).toLocaleDateString('en-US', { month: 'short', day: 'numeric' })
}
</script>

<style scoped></style>
