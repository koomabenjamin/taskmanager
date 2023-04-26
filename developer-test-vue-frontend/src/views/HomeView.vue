<script setup>
import useTasks from '../composables/tasks';
import { onMounted } from 'vue';

    const { tasks, getTasks } = useTasks();
    onMounted(() => getTasks());
</script>

<template>
  <main>
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-4 flex justify-end m-2 p-2 w-full">
      <div class="text-gray-500 dark:text-gray-400 flex space-y-4 w-80">
        <nav class="flex justify-between" aria-label="Breadcrumb">
          <ol class="inline-flex items-center mb-3 sm:mb-0">
            <li>
              <div class="flex items-center">
                <button id="dropdownProject" data-dropdown-toggle="dropdown-project" class="inline-flex items-center px-3 py-2 text-sm font-normal text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-900 dark:hover:bg-gray-800 dark:text-white dark:focus:ring-gray-700">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star pr-1" viewBox="0 0 16 16">
  <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
</svg>Statra Insurance<svg class="w-5 h-5 ml-1" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg></button>
                <div id="dropdown-project" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                  <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefault">
                    <li>
                      <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Insurance 1</a>
                    </li>
                    <li>
                      <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Insurance 2</a>
                    </li>
                  </ul>
                </div> 
              </div>
            </li>
            </ol>
          </nav>
      </div>
      <div class="text-gray-500 dark:text-gray-400 flex space-y-4 w-5">
        <h5>To Do</h5>
      </div>
      <div class="text-gray-500 dark:text-gray-400 flex space-y-4 w-5">
        <nav class="flex justify-between" aria-label="Breadcrumb">
          <ol class="inline-flex items-center mb-3 sm:mb-0">
            <li>
              <div class="flex items-center">
                <button id="dropdownProject" data-dropdown-toggle="dropdown-project" class="inline-flex items-center px-3 py-2 text-sm font-normal text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-900 dark:hover:bg-gray-800 dark:text-white dark:focus:ring-gray-700"><svg class="mr-1.5 w-3 h-3" aria-hidden="true" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M80 104c13.3 0 24-10.7 24-24s-10.7-24-24-24S56 66.7 56 80s10.7 24 24 24zm80-24c0 32.8-19.7 61-48 73.3v87.8c18.8-10.9 40.7-17.1 64-17.1h96c35.3 0 64-28.7 64-64v-6.7C307.7 141 288 112.8 288 80c0-44.2 35.8-80 80-80s80 35.8 80 80c0 32.8-19.7 61-48 73.3V160c0 70.7-57.3 128-128 128H176c-35.3 0-64 28.7-64 64v6.7c28.3 12.3 48 40.5 48 73.3c0 44.2-35.8 80-80 80s-80-35.8-80-80c0-32.8 19.7-61 48-73.3V352 153.3C19.7 141 0 112.8 0 80C0 35.8 35.8 0 80 0s80 35.8 80 80zm232 0c0-13.3-10.7-24-24-24s-24 10.7-24 24s10.7 24 24 24s24-10.7 24-24zM80 456c13.3 0 24-10.7 24-24s-10.7-24-24-24s-24 10.7-24 24s10.7 24 24 24z"/></svg>Apps<svg class="w-5 h-5 ml-1" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg></button>
                <div id="dropdown-project" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                  <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefault">
                    <li>
                      <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">App 1</a>
                    </li>
                    <li>
                      <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">App 2</a>
                    </li>
                  </ul>
                </div> 
              </div>
            </li>
            </ol>
          </nav>
      </div>
      <div class="text-gray-500 dark:text-gray-400 flex flex-col space-y-4 w-5">
        <div class="flex justify-end m-2 p-2">
          <RouterLink :to="{name: 'taskcreate'}" class="inline-flex px-4 py-2 dark:bg-gray-800 dark:hover:bg-gray-700 text-white rounded">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 mt-2" fill="currentColor" viewBox="0 0 20 20">
          <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
          </svg>Add new Task</RouterLink>
        </div>
      </div>
    </div>

    <div class="grid grid-cols-1 gap-6 sm:grid-cols-3 flex justify-end m-2 p-2">
      <div class="mb-4 text-gray-500 dark:text-gray-400 flex flex-col space-y-4 w-80">
        <h5>Backlog</h5>
      </div>
      <div class="mb-4 text-gray-500 dark:text-gray-400 flex flex-col space-y-4 w-80">
        <h5>Priority Chart</h5>
      </div>
      <div class="mb-4 text-gray-500 dark:text-gray-400 flex flex-col space-y-4 w-80">
        <h5>Kanban Workflow</h5>
      </div>
    </div>

    <div class="grid grid-cols-1 gap-6 sm:grid-cols-3 flex justify-end m-2 p-2">
      <div class="mb-4 text-gray-500 dark:text-gray-400 flex flex-col space-y-4 w-80">
        <h5>Backlog</h5>
      </div>
      <div class="mb-4 text-gray-500 dark:text-gray-400 flex flex-col space-y-4 w-80">
        <h5>Select Timeframe</h5>
      </div>
      <div class="mb-4 text-gray-500 dark:text-gray-400 flex flex-col space-y-4 w-80">
        <h5>Share</h5>
      </div>
    </div>

    <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
    <div class="mb-4 text-gray-500 dark:text-gray-400 flex flex-col space-y-4 w-80">
    <h5>To Do</h5>
    <div v-for="task in tasks" :key="task.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 rounded-lg">
      <p class="px-6 py-4">{{ task.name }}</p>
      <span class="px-6 py-4">{{ task.project_id }}</span>
      <p class="px-6 py-2 bg-cyan-500 hover:bg-cyan-600">{{ task.category }}</p>
      <span class="px-6 py-4 text-slate-500">{{ task.priority_level }}</span>
    </div>
    <div class="flex justify-end m-2 p-2">
      <RouterLink :to="{name: 'taskcreate'}" class="inline-flex px-4 py-2">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 pl-1 pt-1 mr-2 bg-orange-500 rounded-full" fill="currentColor" viewBox="0 0 20 20">
      <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
      </svg>Add new task</RouterLink>
    </div>
</div>
<div class="mb-4 text-gray-500 dark:text-gray-400 flex flex-col space-y-4 w-80">
    <h5>In Progress</h5>
    <div v-for="task in tasks" :key="task.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 rounded-lg">
      <p class="px-6 py-4">{{ task.name }}</p>
      <span class="px-6 py-4">{{ task.project_id }}</span>
      <p class="px-6 py-2 bg-cyan-500 hover:bg-cyan-600">{{ task.category }}</p>
      <span class="px-6 py-4 text-slate-500">{{ task.priority_level }}</span>
    </div>
    <div class="flex justify-end m-2 p-2">
      <RouterLink :to="{name: 'taskcreate'}" class="inline-flex px-4 py-2">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 pl-1 pt-1 mr-2 bg-orange-500 rounded-full" fill="currentColor" viewBox="0 0 20 20">
      <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
      </svg>Add new task</RouterLink>
    </div>
</div>
<div class="mb-3 text-gray-500 dark:text-gray-400 flex flex-col space-y-4">
    <h5>Finished</h5>
    <div v-for="task in tasks" :key="task.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 rounded-lg">
      <p class="px-6 py-4">{{ task.name }}</p>
      <span class="px-6 py-4">{{ task.project_id }}</span>
      <p class="px-6 py-2 bg-cyan-500 hover:bg-cyan-600">{{ task.category }}</p>
      <span class="px-6 py-4 text-slate-500">{{ task.priority_level }}</span>
    </div>
    <div class="flex justify-end m-2 p-2">
      <RouterLink :to="{name: 'taskcreate'}" class="inline-flex px-4 py-2">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 pl-1 pt-1 mr-2 bg-orange-500 rounded-full" fill="currentColor" viewBox="0 0 20 20">
      <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
      </svg>Add new task</RouterLink>
    </div>
</div>
</div>
  </main>
</template>
