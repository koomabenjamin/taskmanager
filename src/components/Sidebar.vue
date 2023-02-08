<script setup lang="ts">
import { PlusIcon } from "@heroicons/vue/20/solid";
</script>

<template>
  <div class="w-1/5 h-full px-5 pt-5 space-y-2">
    <div>
      <h3 class="text-xl font-bold">Flows list</h3>
    </div>
    <button
      class="flex items-center justify-center mb-6 mx-auto h-10 w-full rounded-md bg-lime-200 text-sm"
    >
      <PlusIcon class="h-4 w-4" />
      <p class="ml-2">Add New Task</p>
    </button>
  </div>
</template>
