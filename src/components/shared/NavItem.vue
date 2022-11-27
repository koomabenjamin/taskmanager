<template>
  <div
    @click="openCloseSublists(props.label)"
    class="w-full h-10 px-2 rounded hover:bg-yellow-100 flex items-center justify-between">
    <div class="flex items-center space-x-2 text-sm">
      <component class="h-6 w-6 stroke-2" :is="Icons[props.icon]"></component>
      <span class="font-semibold">{{ props.label }}</span>
    </div>
    <div>
      <component 
        class="h-5 w-5 stroke-2" 
        :is="Icons['ChevronDownIcon']" 
        v-if="props.subList.length > 0 && !subListsOpen.includes(props.label)"
        >
      </component>
      <component 
        class="h-5 w-5 stroke-2" 
        :is="Icons['ChevronUpIcon']" 
        v-if="props.subList.length > 0 && subListsOpen.includes(props.label)"
        >
      </component>
    </div>
  </div>
  <div v-if="props.subList.length > 0 && subListsOpen.includes(props.label)" class="pl-10 space-y-4">
    <div v-for="item in props.subList" :key="item">
      <div :class="{'bg-yellow-300': item.name === 'Statra Insurance'}" class="flex items-center space-x-2 cursor-pointer p-1 rounded">
        <span :class="`h-3 w-3 ${item.color} rounded-full`"></span>
        <span class="text-sm">{{ item.name }}</span>
      </div>
    </div>
    <div class="flex items-center space-x-2">
      <component 
        class="h-7 w-7 stroke-2" 
        :is="Icons['PlusCircleIcon']" 
        v-if="props.subList.length > 0 && subListsOpen.includes(props.label)"
        >
      </component>
      <span>Add {{ props.name }}</span>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import * as Icons from '@heroicons/vue/24/outline'
const props =  defineProps({
  name: [String, Number],
  label: [String, Number],
  icon: [String, Number],
  subList: [Array, Object],
})

const subListsOpen = ref([]);

const openCloseSublists = (subList) => {
  if(!subListsOpen.value.includes(subList)) subListsOpen.value.push(subList); 
  else {
    let indexOfList = subListsOpen.value.indexOf(subList);
    if (indexOfList !== -1) subListsOpen.value.splice(indexOfList, 1);
  }
}

</script>

<style>

</style>