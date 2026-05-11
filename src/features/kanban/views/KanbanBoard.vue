<template>
  <div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
      <div>
        <h1 class="text-3xl font-bold text-emerald-900">Kanban Board</h1>
        <p class="text-gray-600 mt-2">Organize your tasks by status with drag-and-drop</p>
      </div>
      <div class="flex space-x-2">
        <Button label="Add Column" icon="PlusIcon" variant="primary" @click="showAddCategoryModal = true" />
        <Button label="Swimlanes" icon="ViewColumnsIcon" variant="secondary" @click="viewMode = 'swimlane'" :disabled="viewMode === 'swimlane'" />
        <Button label="Board" icon="WindowIcon" variant="secondary" @click="viewMode = 'board'" :disabled="viewMode === 'board'" />
      </div>
    </div>

    <!-- Board View -->
    <div v-if="viewMode === 'board'">
      <!-- Kanban Columns -->
      <div class="grid gap-6 overflow-x-auto" :style="{ gridTemplateColumns: `repeat(${taskStore.sortedCategories.length}, minmax(350px, 1fr))` }">
        <div
          v-for="column in taskStore.sortedCategories"
          :key="column.id"
          @dragover="dragOverColumn = column.id"
          @dragleave="dragOverColumn = null"
          @drop="dropTask($event, column.id)"
          :class="[
            'bg-white rounded p-4 shadow border border-t-2 transition-all',
            dragOverColumn === column.id ? 'ring-2 ring-emerald-500 shadow-lg border-t-emerald-500' : 'border-gray-200 border-t-emerald-500'
          ]"
        >
          <div class="flex items-center justify-between mb-4">
            <h3 class="font-bold text-lg text-gray-800">{{ column.name }}</h3>
            <div class="flex items-center space-x-2">
              <span class="text-xs font-bold text-gray-600 bg-gray-200 px-2 py-1 rounded-full">
                {{ getTasksByStatus(column.id).length }}
              </span>
              <button
                v-if="authStore.hasPermission('manage_categories')"
                @click="deleteCategory(column.id)"
                class="text-red-600 hover:text-red-800 text-sm font-semibold"
              >
                ✕
              </button>
            </div>
          </div>

          <div class="space-y-3 min-h-96">
            <div
              v-for="task in getTasksByStatus(column.id)"
              :key="task.id"
              draggable="true"
              @dragstart="draggedTask = task"
              @dragend="draggedTask = null"
              class="p-3 bg-gradient-to-br from-white to-emerald-50 rounded border-l-2 border-emerald-600 hover:shadow-md transition-all cursor-move group"
            >
              <div class="flex justify-between items-start">
                <p class="font-semibold text-sm text-gray-800 flex-1">{{ task.title }}</p>
                <button
                  v-if="authStore.hasPermission('delete_task')"
                  @click="deleteTask(task.id)"
                  class="opacity-0 group-hover:opacity-100 text-red-600 hover:text-red-800 text-xs font-semibold transition-opacity"
                >
                  ✕
                </button>
              </div>

              <p class="text-xs text-gray-600 mt-2">{{ task.description }}</p>

              <div class="flex items-center justify-between mt-3">
                <div class="flex space-x-1">
                  <Tag
                    v-for="tag in task.tags.slice(0, 2)"
                    :key="tag"
                    :label="tag"
                    color="info"
                  />
                </div>
                <span :class="['text-xs font-bold px-2 py-1 rounded', getPriorityClass(task.priority)]">
                  {{ task.priority.toUpperCase() }}
                </span>
              </div>

              <div v-if="task.assignees" class="flex -space-x-2 mt-3">
                <div
                  v-for="(assignee, idx) in task.assignees.slice(0, 3)"
                  :key="assignee"
                  class="w-6 h-6 rounded-full bg-emerald-600 border border-white text-xs text-white flex items-center justify-center font-bold"
                  :title="assignee"
                >
                  {{ assignee[0] }}
                </div>
                <div
                  v-if="task.assignees.length > 3"
                  class="w-6 h-6 rounded-full bg-gray-400 border border-white text-xs text-white flex items-center justify-center font-bold"
                >
                  +{{ task.assignees.length - 3 }}
                </div>
              </div>

              <div class="text-xs text-gray-500 mt-2">Due: {{ formatDate(task.dueDate) }}</div>
            </div>

            <!-- Add task button -->
            <button
              @click="showAddTaskModal = true; newTaskStatus = column.id"
              class="w-full py-2 rounded border border-dashed border-gray-300 text-gray-600 hover:border-emerald-600 hover:text-emerald-700 transition-all font-semibold text-sm"
            >
              + Add Task
            </button>
          </div>
        </div>
      </div>

      <!-- Statistics -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="bg-white rounded p-6 shadow border border-gray-200">
          <h3 class="text-lg font-bold text-emerald-900 mb-4">Statistics</h3>
          <div class="space-y-3">
            <div class="flex justify-between items-center">
              <span class="text-gray-700">Total Tasks</span>
              <span class="font-bold text-lg text-emerald-700">{{ taskStore.tasks.length }}</span>
            </div>
            <div v-for="cat in taskStore.sortedCategories" :key="cat.id" class="flex justify-between items-center">
              <span class="text-gray-700">{{ cat.name }}</span>
              <span class="font-bold text-lg" :class="`text-${getCategoryColor(cat.id)}-700`">
                {{ getTasksByStatus(cat.id).length }}
              </span>
            </div>
          </div>
        </div>

        <!-- Task History -->
        <div class="lg:col-span-2 bg-white rounded p-6 shadow border border-gray-200">
          <h3 class="text-lg font-bold text-emerald-900 mb-4">Recent Changes</h3>
          <div class="space-y-2 max-h-64 overflow-y-auto">
            <div
              v-for="history in taskStore.getTaskHistory().slice(0, 10)"
              :key="history.id"
              class="p-3 bg-gray-50 rounded text-sm"
            >
              <p class="font-semibold text-gray-800">{{ history.taskTitle }}</p>
              <p class="text-xs text-gray-600">
                Moved from <span class="font-bold">{{ formatCategoryName(history.from) }}</span>
                to <span class="font-bold">{{ formatCategoryName(history.to) }}</span>
              </p>
              <p class="text-xs text-gray-500">{{ formatTime(history.timestamp) }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Swimlane View -->
    <div v-else-if="viewMode === 'swimlane'">
      <SwimlaneBoardView :tasks="taskStore.tasks" :categories="taskStore.sortedCategories" @drop-task="dropTask" />
    </div>

    <!-- Add Category Modal -->
    <div v-if="showAddCategoryModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
      <Card class="p-8 max-w-md w-full">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Add New Category</h2>
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Category Name</label>
            <input
              v-model="newCategoryName"
              type="text"
              placeholder="e.g., Review, Testing"
              class="w-full px-3 py-2 border border-emerald-200 rounded focus:outline-none focus:ring-2 focus:ring-emerald-500"
            />
          </div>
          <div class="flex space-x-2">
            <Button label="Create" variant="primary" @click="createCategory" style="flex: 1" />
            <Button label="Cancel" variant="secondary" @click="showAddCategoryModal = false" style="flex: 1" />
          </div>
        </div>
      </Card>
    </div>

    <!-- Add Task Modal -->
    <div v-if="showAddTaskModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
      <Card class="p-8 max-w-md w-full max-h-96 overflow-y-auto">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Add New Task</h2>
        <div class="space-y-3">
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Task Title</label>
            <input
              v-model="newTask.title"
              type="text"
              placeholder="Task name"
              class="w-full px-3 py-2 border border-emerald-200 rounded focus:outline-none focus:ring-2 focus:ring-emerald-500"
            />
          </div>
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
            <textarea
              v-model="newTask.description"
              placeholder="Task description"
              class="w-full px-3 py-2 border border-emerald-200 rounded focus:outline-none focus:ring-2 focus:ring-emerald-500 h-20"
            ></textarea>
          </div>
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Priority</label>
            <select
              v-model="newTask.priority"
              class="w-full px-3 py-2 border border-emerald-200 rounded focus:outline-none focus:ring-2 focus:ring-emerald-500"
            >
              <option value="low">Low</option>
              <option value="medium" selected>Medium</option>
              <option value="high">High</option>
            </select>
          </div>
          <div class="flex space-x-2">
            <Button label="Create" variant="primary" @click="createTask" style="flex: 1" />
            <Button label="Cancel" variant="secondary" @click="showAddTaskModal = false" style="flex: 1" />
          </div>
        </div>
      </Card>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { useTaskStore } from '@/stores/taskStore'
import { useAuthStore } from '@/stores/authStore'
import Button from '@/features/shared/components/Button.vue'
import Card from '@/features/shared/components/Card.vue'
import Tag from '@/features/shared/components/Tag.vue'
import SwimlaneBoardView from '../components/SwimlaneBoardView.vue'

const taskStore = useTaskStore()
const authStore = useAuthStore()

const viewMode = ref('board')
const draggedTask = ref(null)
const dragOverColumn = ref(null)
const showAddCategoryModal = ref(false)
const showAddTaskModal = ref(false)
const newCategoryName = ref('')
const newTaskStatus = ref('todo')

const newTask = ref({
  title: '',
  description: '',
  priority: 'medium',
  assignees: [],
  tags: [],
  dueDate: new Date().toISOString().split('T')[0]
})

const getTasksByStatus = (status) => {
  return taskStore.getTasksByStatus(status)
}

const dropTask = (event, targetStatus) => {
  event.preventDefault()
  if (draggedTask.value) {
    taskStore.updateTaskStatus(draggedTask.value.id, targetStatus)
    draggedTask.value = null
    dragOverColumn.value = null
  }
}

const getPriorityClass = (priority) => {
  const classes = {
    high: 'bg-red-100 text-red-700',
    medium: 'bg-yellow-100 text-yellow-700',
    low: 'bg-blue-100 text-blue-700'
  }
  return classes[priority] || 'bg-gray-100 text-gray-700'
}

const getCategoryColor = (categoryId) => {
  const colors = {
    todo: 'blue',
    doing: 'yellow',
    done: 'green'
  }
  return colors[categoryId] || 'gray'
}

const formatDate = (date) => {
  return new Date(date).toLocaleDateString('en-US', { month: 'short', day: 'numeric' })
}

const formatTime = (date) => {
  const now = new Date()
  const time = new Date(date)
  const diff = now - time
  const minutes = Math.floor(diff / 60000)
  const hours = Math.floor(diff / 3600000)
  const days = Math.floor(diff / 86400000)

  if (minutes < 60) return `${minutes}m ago`
  if (hours < 24) return `${hours}h ago`
  return `${days}d ago`
}

const formatCategoryName = (categoryId) => {
  const cat = taskStore.categories.find(c => c.id === categoryId)
  return cat?.name || categoryId
}

const createCategory = () => {
  if (newCategoryName.value.trim()) {
    taskStore.addCategory({
      name: newCategoryName.value,
      color: 'bg-indigo-100',
      textColor: 'text-indigo-700'
    })
    newCategoryName.value = ''
    showAddCategoryModal.value = false
  }
}

const deleteCategory = (categoryId) => {
  if (confirm('Are you sure you want to delete this category? Tasks will need to be moved first.')) {
    if (getTasksByStatus(categoryId).length === 0) {
      taskStore.deleteCategory(categoryId)
    } else {
      alert('Please move all tasks out of this category first.')
    }
  }
}

const createTask = () => {
  if (newTask.value.title.trim()) {
    taskStore.addTask({
      ...newTask.value,
      status: newTaskStatus.value
    })
    newTask.value = {
      title: '',
      description: '',
      priority: 'medium',
      assignees: [],
      tags: [],
      dueDate: new Date().toISOString().split('T')[0]
    }
    showAddTaskModal.value = false
  }
}

const deleteTask = (taskId) => {
  if (confirm('Are you sure you want to delete this task?')) {
    taskStore.deleteTask(taskId)
  }
}
</script>

<style scoped></style>



