<template>
  <div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
      <div>
        <h1 class="text-3xl font-bold text-emerald-900">Backlog</h1>
        <p class="text-gray-600 mt-2">Manage and prioritize all your tasks in one place</p>
      </div>
      <Button label="Add Task" icon="PlusIcon" variant="primary" />
    </div>

    <!-- Filter & Sort -->
    <div class="bg-white rounded p-4 shadow border border-gray-200 flex items-center space-x-4">
      <input placeholder="Search tasks..." class="flex-1 px-3 py-2 border border-emerald-200 rounded" />
      <select class="px-3 py-2 border border-emerald-200 rounded">
        <option>Sort by: Date Added</option>
        <option>Sort by: Priority</option>
        <option>Sort by: Due Date</option>
      </select>
      <select class="px-3 py-2 border border-emerald-200 rounded">
        <option>Filter: All</option>
        <option>Filter: Pending</option>
        <option>Filter: In Review</option>
      </select>
    </div>

    <!-- Backlog List -->
    <div class="space-y-2">
      <BacklogItem
        v-for="task in backlogTasks"
        :key="task.id"
        :task="task"
      />
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import Button from '@/features/shared/components/Button.vue'
import BacklogItem from '../components/BacklogItem.vue'

const backlogTasks = ref([
  { id: 1, title: 'Implement User Authentication', status: 'pending', priority: 'high', dueDate: '2026-05-15', assignee: 'John Doe', description: 'Add JWT-based authentication' },
  { id: 2, title: 'Design Database Schema', status: 'in-review', priority: 'high', dueDate: '2026-05-12', assignee: 'Sarah Williams', description: 'Create normalized database structure' },
  { id: 3, title: 'API Documentation', status: 'pending', priority: 'medium', dueDate: '2026-05-20', assignee: 'Jane Smith', description: 'Document all API endpoints' },
  { id: 4, title: 'UI Component Library', status: 'pending', priority: 'medium', dueDate: '2026-05-25', assignee: 'Mike Johnson', description: 'Create reusable UI components' },
  { id: 5, title: 'Performance Testing', status: 'pending', priority: 'low', dueDate: '2026-06-01', assignee: 'John Doe', description: 'Load testing and optimization' }
])
</script>

<style scoped></style>


