<script setup>
 import useTasks from '../../composables/tasks';
import { onMounted } from 'vue';
    const { tasks, getTasks } = useTasks();
    onMounted(() => getTasks());
</script>

<template>
  <div class="mt-12 mr-12 w-full">
  <div class="flex justify-end m-2 p-2">
     <RouterLink :to="{name: 'taskcreate'}" class="inline-flex px-4 py-2 dark:bg-gray-800 dark:hover:bg-gray-700 text-white rounded">
     <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 mt-2" fill="currentColor" viewBox="0 0 20 20">
    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
    </svg>Add Task</RouterLink>
  </div>
    
<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Task Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Project Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Category
                </th>
                <th scope="col" class="px-6 py-3">
                    Priority Level
                </th>
                <th scope="col" class="px-6 py-3">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="task in tasks" :key="task.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td class="px-6 py-4">{{ task.name }}</td>
                <td class="px-6 py-4">{{ task.project_id }}</td>
                <td class="px-6 py-4">{{ task.category }}</td>
                <td class="px-6 py-4">{{ task.priority_level }}</td>
                <td class="px-6 py-4">
                Edit / Delete
                </td>
            </tr>
        </tbody>
    </table>
</div>

  </div>
</template>
