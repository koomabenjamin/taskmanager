<template>
  <!-- Tab container -->
  <div>
    <!-- Tab header -->
    <div class="flex justify-between items-center border-b px-4 py-2">
      <h2 class="text-lg font-semibold">Past Due Tasks</h2>
      <!-- Filter controls -->
      <div class="flex space-x-4 items-center">
        <div>
          <label for="category">Category:</label>
          <select id="category" v-model="selectedCategory" @change="filterPastDueTasks">
            <option value="">All</option>
            <option value="high">High</option>
            <option value="medium">Medium</option>
            <option value="low">Low</option>
          </select>
        </div>
        <div>
          <label for="member">Member:</label>
          <select id="member" v-model="selectedMember" @change="filterPastDueTasks">
            <option value="">All</option>
            <option v-for="member in members" :key="member" :value="member">{{ member }}</option>
          </select>
        </div>
        <div>
          <label for="date">Date:</label>
          <input type="date" id="date" v-model="selectedDate" @change="filterPastDueTasks">
        </div>
      </div>
    </div>

    <!-- Task list -->
    <div class="flex flex-wrap">
      <div v-if="filteredPastDueTasks.length === 0" class="text-gray-500 text-lg py-6 px-4 mx-auto">
        No past due tasks found.
      </div>
      <div v-for="task in filteredPastDueTasks" :key="task.id" class="w-1/3 p-4">
        <!-- Task card -->
        <div class="bg-white shadow rounded-lg p-4">
          <h3 class="font-semibold text-lg">{{ task.title }}</h3>
          <div class="flex items-center space-x-2 mt-2">
            <div class="h-6 w-6 rounded-full bg-gray-300"></div>
            <div class="text-sm text-gray-600">Priority: {{ task.priority }}</div>
          </div>
          <div class="flex items-center space-x-2 mt-2">
            <CalendarIcon class="h-5 w-5 text-gray-500" />
            <span class="text-sm text-gray-600">{{ task.date }}</span>
          </div>
          <div class="mt-4">
            <span class="px-2 py-1 text-sm font-semibold text-gray-600 bg-gray-200 rounded">{{ task.status }}</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { CalendarIcon } from '@heroicons/vue/24/outline'

const selectedCategory = ref("")
const selectedMember = ref("")
const selectedDate = ref("")

const tasks = ref([
  { id: 1, title: 'Task 1', status: 'Past Due', priority: 'high', date: '2022-06-20', members: [1, 2] },
  { id: 2, title: 'Task 2', status: 'Past Due', priority: 'high', date: '2022-06-15', members: [1] },
  { id: 3, title: 'Task 3', status: 'Past Due', priority: 'medium', date: '2022-06-18', members: [1, 2, 3] },
  { id: 4, title: 'Task 4', status: 'Past Due', priority: 'low', date: '2022-06-17', members: [1, 4, 5] },
  { id: 5, title: 'Task 5', status: 'Past Due', priority: 'low', date: '2022-06-19', members: [1, 3, 4, 5] },
])

const members = ref([1, 2, 3, 4, 5])

const filterPastDueTasks = () => {
  filteredPastDueTasks.value = tasks.value.filter(task => {
    return (
      (selectedCategory.value === '' || task.priority === selectedCategory.value) &&
      (selectedMember.value === '' || task.members.includes(parseInt(selectedMember.value))) &&
      (selectedDate.value === '' || task.date === selectedDate.value)
    )
  })
}

const filteredPastDueTasks = computed(() => {
  return tasks.value.filter(task => {
    return (
      (selectedCategory.value === '' || task.priority === selectedCategory.value) &&
      (selectedMember.value === '' || task.members.includes(parseInt(selectedMember.value))) &&
      (selectedDate.value === '' || task.date === selectedDate.value)
    )
  })
})
</script>

<style scoped>
/* Add your scoped styles here */
</style>
