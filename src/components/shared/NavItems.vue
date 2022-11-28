<template>
  <div
    v-for="item in props.items"
    :key="item"
    @click="openCloseSublists(item.label)"
    class="w-full h-auto flex-col flex -my-2">
    <div class="flex h-12 items-center hover:bg-yellow-100 justify-between p-1 hover:border hover:shadow-md rounded">
      <div class="flex items-center space-x-2 text-sm">
        <component class="h-6 w-6 stroke-2" :is="Icons[item.icon]"></component>
        <span class="font-semibold">{{ item.label }}</span>
      </div>
      <div>
        <component
          class="h-5 w-5 stroke-2"
          :is="Icons['ChevronDownIcon']"
          v-if="item.subList.length > 0 && !subListsOpen.includes(item.label)"
          >
        </component>
        <component
          class="h-5 w-5 stroke-2"
          :is="Icons['ChevronUpIcon']"
          v-if="item.subList.length > 0 && subListsOpen.includes(item.label)"
          >
        </component>
      </div>
    </div>
    <div v-if="item.subList.length > 0 && subListsOpen.includes(item.label)" class="pl-10 space-y-4">
      <div v-for="item in item.subList" :key="item">
        <div :class="{'bg-yellow-300': item.name === 'Statra Insurance'}" class="flex items-center space-x-2 cursor-pointer p-1 rounded">
          <span :class="`h-3 w-3 ${item.color} rounded-full`"></span>
          <span class="text-sm">{{ item.name }}</span>
        </div>
      </div>
      <div class="flex items-center space-x-2" @click="showForm(item.name)">
        <component 
          class="h-6 w-6 stroke-2" 
          :is="Icons['PlusCircleIcon']"
          @click="showModal(item.name)"
          v-if="item.subList.length > 0 && subListsOpen.includes(item.label)"
          >
        </component>
        <span>Add {{ item.name }}</span>
      </div>
    </div>
  </div>

  <Modal>
    <template v-slot:heading>Add Task</template>
    <template v-slot:form>
      <div class="grid grid-cols-2 gap-2 -space-y-0">
        <div class="bg-rose-600 w-full h-10 mt-4 col-span-2"></div>
        <div class="bg-rose-600 w-full h-10 mt-4"></div>
        <div class="bg-rose-600 w-full h-10 mt-4"></div>
      </div>
    </template>
  </Modal>
</template>

<script setup>
import { ref } from 'vue'
import * as Icons from '@heroicons/vue/24/outline'
import Modal from './Modal.vue'

const props =  defineProps({
  name: [String, Number],
  label: [String, Number],
  icon: [String, Number],
  subList: [Array, Object],
  items: [Array, Object],
})

const subListsOpen = ref([]);

const openCloseSublists = (subList) => {
  if(!subListsOpen.value.includes(subList)) subListsOpen.value.push(subList); 
  else {
    let indexOfList = subListsOpen.value.indexOf(subList);
    if (indexOfList !== -1) subListsOpen.value.splice(indexOfList, 1);
  }
}

const showForm = (form) => {
  switch (form) {
    case 'member':
      
      break;
  
    default:
      break;
  }
} 

</script>

<style>

</style>