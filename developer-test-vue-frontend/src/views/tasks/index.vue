<script setup>
 import useTasks from '../../composables/tasks';
import { onMounted } from 'vue';
    const { tasks, getTasks } = useTasks();
    onMounted(() => getTasks());
</script>

<template>
  <div class="mt-12 mr-12 w-full">
  <div class="flex justify-end m-2 p-2">
     <RouterLink :to="{name: 'taskcreate'}" class="inline-flex px-4 py-2 bg-gray-500 hover:bg-gray-700 text-white rounded">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
</svg>
Add Task</RouterLink>
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
                <td class="px-6 py-4 space-x-2">
                    <RouterLink :to="{name: 'taskedit', params: {id: task.id}}" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-1.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Edit</RouterLink>
                    <button @click="deleteTask(task.id)" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-1.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Delete</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

  </div>
</template>
