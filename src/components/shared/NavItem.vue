<template>
  <div class="w-full h-10 px-2 rounded hover:bg-yellow-100 flex items-center justify-between">
    <div class="flex items-center space-x-2 text-sm">
      <component class="h-5 w-5 stroke-2" :is="Icons[props.icon]"></component>
      <span class="font-semibold">{{ props.label }}</span>
    </div>
    <component class="h-5 w-5 stroke-2" :is="Icons['ChevronDownIcon']" v-if="props.subList.length > 0"></component>
  </div>
  <div v-if="props.subList.length > 0" class="pl-10 space-y-6">
    <div v-for="item in props.subList" :key="item" class="flex items-center space-x-2 cursor-pointer">
      <span :class="`h-3 w-3 ${item.color} rounded-full`"></span>
      <span class="text-sm">{{ item.name }}</span>
    </div>
  </div>
</template>

<script setup>
import * as Icons from '@heroicons/vue/24/outline'
const props =  defineProps({
  label: [String, Number],
  icon: [String, Number],
  subList: [Array, Object],
})
</script>

<style>

</style>