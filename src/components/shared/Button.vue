<template>
  <button class="bg-lime-300 px-10 py-4 text-sm rounded font-semibold flex items-center space-x-2 shadow">
    <component class="h-5 w-5 stroke-2" :is="Icons[props.icon]"></component>
    <span>{{ props.label }}</span>
  </button>
</template>

<script setup>
import * as Icons from '@heroicons/vue/24/outline'

const props =  defineProps({
  label: [String, Number],
  icon: [String, Number],
})
</script>

<style>

</style>