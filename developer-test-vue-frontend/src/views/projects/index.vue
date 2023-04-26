<script setup>
import useProjects from '../../composables/projects';
import { onMounted } from 'vue';

    const { projects, getProjects, deleteProject } = useProjects();
    onMounted(() => getProjects());
</script>

<template>
  <div class="mt-12 mr-12 w-full">
  <div class="flex justify-end m-2 p-2">
     <RouterLink :to="{name: 'projectcreate'}" class="inline-flex px-4 py-2 bg-gray-500 hover:bg-gray-700 text-white rounded">
     <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
    </svg>Add Project</RouterLink>
  </div>
    
<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Project Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Project Description
                </th>
                <th scope="col" class="px-6 py-3">
                    Date Added
                </th>
                <th scope="col" class="px-6 py-3">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="project in projects" :key="project.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td class="px-6 py-4">{{ project.name }}</td>
                <td class="px-6 py-4">{{ project.description }}</td>
                <td class="px-6 py-4">{{ project.created_at }}</td>
                <td class="px-6 py-4 space-x-2">
                    <RouterLink :to="{name: 'projectedit', params: {id: project.id}}" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-1.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Edit</RouterLink>
                    <button @click="deleteProject(project.id)" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-1.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Delete</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

  </div>
</template>
