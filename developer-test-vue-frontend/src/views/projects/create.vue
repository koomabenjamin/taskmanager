<script setup>

import { ref } from 'vue';
import useProjects from '../../composables/projects';
const { storeProject, errors } = useProjects();

const form = ref({
   name: "",
   description: ""
});

</script>

<template>
  <main>
    
    <form class="max-w-md mx-auto shadow-md bg-white p-4 rounded-lg" @submit.prevent="storeProject(form)">
      <div class="mb-6 w-80">
        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Project Name</label>
        <input type="name" id="name" v-model="form.name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Project Name" required>
        <div v-if="errors.name">
             <span class="text-sm text-red-400">{{ errors.name[0] }}</span>
        </div>
      </div>
      <div class="mb-6 w-80">
        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Project Description</label>
        <textarea id="description" rows="4" v-model="form.description" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Project Description ..."></textarea>
      </div>
      <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save Project</button>
    </form>

  </main>
</template>
