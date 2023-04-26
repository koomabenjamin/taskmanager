<script setup>
import useTasks from '../composables/tasks';
import { onMounted } from 'vue';

    const { tasks, getTasks } = useTasks();
    onMounted(() => getTasks());
</script>

<template>
  <main>
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 flex">
      <div class="flex flex-col">
        <nav class="flex justify-between" aria-label="Breadcrumb">
          <ol class="inline-flex items-center mb-3 sm:mb-0">
            <li>
              <div class="flex items-center">
                <button id="dropdownProject" data-dropdown-toggle="dropdown-project" class="inline-flex items-center px-3 py-2 text-sm font-normal text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-900 dark:hover:bg-gray-800 dark:text-white dark:focus:ring-gray-700">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
</svg>
Statra Insurance<svg class="w-5 h-5 ml-1" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg></button>
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
      <div class="flex flex-col grid grid-cols-1 sm:grid-cols-3">
      <div class="flex flex-col">
        <img class="rounded-full w-28 h-28" src="/docs/images/examples/image-4@2x.jpg" alt="User image">
        
      </div>
      <div class="flex flex-col">
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
      <div class="flex flex-col">
        <div class="flex justify-end m-2">
          <RouterLink :to="{name: 'taskcreate'}" class="inline-flex px-4 py-2 bg-gray-500 hover:bg-gray-700 text-white rounded">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
</svg>Add new Task</RouterLink>
        </div>
      </div>
    </div>
    </div>

    <div class="grid grid-cols-1 gap-6 sm:grid-cols-3 flex mb-2">
      <div class="flex flex-col">
        <h5>Backlog</h5>
      </div>
      <div class="flex flex-col">
        <h5>Priority Chart</h5>
      </div>
      <div class="flex flex-col">
        <h5>Kanban Workflow</h5>
      </div>
    </div>

    <div class="grid grid-cols-1 gap-6 sm:grid-cols-3 mb-2">
      <div class="flex flex-col">
        <h5>Backlog</h5>
      </div>
      <div class="flex flex-col">
        <h5>Select Timeframe</h5>
      </div>
      <div class="flex flex-col">
        <h5>Share</h5>
      </div>
    </div>

    <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
    <div class="mb-4 text-gray-500 dark:text-gray-400 flex flex-col space-y-4 w-80">
      <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
    <h5 class="flex flex-col">To Do</h5>
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 flex justify-end flex flex-col">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
</svg>
</div>
    <div v-for="task in tasks" :key="task.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 rounded-lg">
      <div class="flex m-2 p-2">
        <img class="rounded-full w-28 h-28" src="/docs/images/examples/image-4@2x.jpg" alt="User image">
        <span class="justify-end px-6 py-4 text-slate-500 rounded">{{ task.priority_level }}</span>
      </div>
      <p class="px-6 py-4">{{ task.name }}</p>
      <span class="px-6 py-4">{{ task.tags }}</span>
      <p class="px-6 py-2 bg-cyan-500 hover:bg-cyan-600">{{ task.start_date }} - {{ task.end_date }}</p>
    </div>
    <div class="flex justify-end m-2 p-2">
      <RouterLink :to="{name: 'taskcreate'}" class="inline-flex px-4 py-2">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 mr-2 bg-orange-500 rounded-full">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
</svg>
Add new task</RouterLink>
    </div>
</div>
<div class="mb-4 text-gray-500 dark:text-gray-400 flex flex-col space-y-4 w-80">
  <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
    <h5 class="flex flex-col">In Progress</h5>
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 flex justify-end flex flex-col">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
</svg>
</div>
    <div v-for="task in tasks" :key="task.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 rounded-lg">
      
      <div class="flex m-2 p-2">
        <img class="rounded-full w-28 h-28" src="/docs/images/examples/image-4@2x.jpg" alt="User image">
        <span class="justify-end px-6 py-4 text-slate-500 rounded">{{ task.priority_level }}</span>
      </div>
      <p class="px-6 py-4">{{ task.name }}</p>
      <span class="px-6 py-4">{{ task.tags }}</span>
      <p class="px-6 py-2 bg-cyan-500 hover:bg-cyan-600">{{ task.start_date }} - {{ task.end_date }}</p>
    </div>
    <div class="flex justify-end m-2 p-2">
      <RouterLink :to="{name: 'taskcreate'}" class="inline-flex px-4 py-2">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 mr-2 bg-orange-500 rounded-full">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
</svg>Add new task</RouterLink>
    </div>
</div>
<div class="mb-3 text-gray-500 dark:text-gray-400 flex flex-col space-y-4">
<div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
    <h5 class="flex flex-col">Finished</h5>
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 flex justify-end flex flex-col">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
</svg>
</div>
    <div v-for="task in tasks" :key="task.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 rounded-lg">
      <div class="flex m-2 p-2">
        <img class="rounded-full w-28 h-28" src="/docs/images/examples/image-4@2x.jpg" alt="User image">
        <span class="justify-end px-6 py-4 text-slate-500 rounded">{{ task.priority_level }}</span>
      </div>
      <p class="px-6 py-4">{{ task.name }}</p>
      <span class="px-6 py-4">{{ task.tags }}</span>
      <p class="px-6 py-2 bg-cyan-500 hover:bg-cyan-600">{{ task.start_date }} - {{ task.end_date }}</p>
    </div>
    <div class="flex justify-end m-2 p-2">
      <RouterLink :to="{name: 'taskcreate'}" class="inline-flex px-4 py-2">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 mr-2 bg-orange-500 rounded-full">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
</svg>Add new task</RouterLink>
    </div>
</div>
</div>
  </main>
</template>
