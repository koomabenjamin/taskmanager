<template>
   <div class="h-screen w-screen bg-lime-50 flex">
    <div class="w-1/4 border-r h-full p-10 flex flex-col space-y-5">
      <!-- 
      <Fab label="Add new task" icon="PlusIcon" />
      <Tag label="Add new task" icon="PlusIcon" />
      <Card/> -->
      <div class="font-bold text-lg">Task Master</div>
      <Button label="Add new task" icon="PlusIcon"/>
      <div class="w-full h-12 rounded hover:bg-yellow-100 flex items-center justify-between">
        <div class="flex items-center space-x-2 text-sm">
          <div class="h-8 w-8 bg-black"></div>
          <span class="font-semibold">Plan</span>
        </div>
        <div class="h-5 w-5 bg-black"></div>
      </div>
      <div class="w-full h-12 rounded hover:bg-yellow-100 flex items-center justify-between">
        <div class="flex items-center space-x-2 text-sm">
          <div class="h-8 w-8 bg-black"></div>
          <span class="font-semibold">Plan</span>
        </div>
        <div class="h-5 w-5 bg-black"></div>
      </div>
      <div class="w-full h-12 rounded hover:bg-yellow-100 flex items-center justify-between">
        <div class="flex items-center space-x-2 text-sm">
          <div class="h-8 w-8 bg-black"></div>
          <span class="font-semibold">Plan</span>
        </div>
        <div class="h-5 w-5 bg-black"></div>
      </div>
      <div class="w-full h-12 rounded hover:bg-yellow-100 flex items-center justify-between">
        <div class="flex items-center space-x-2 text-sm">
          <div class="h-8 w-8 bg-black"></div>
          <span class="font-semibold">Plan</span>
        </div>
        <div class="h-5 w-5 bg-black"></div>
      </div>
    </div>
    <div class="w-3/4 flex flex-col">
      <div class="w-full h-24 border-b">Header</div>
      <div class="w-full h-20 border-b">Sub-Header</div>
      <div class="w-full h-full flex overflow-auto">
        <div class="w-1/4 border-r flex-shrink-0 text-xs" v-for="column in [1,2,3,4,5]" :key="column">
            <Card draggable="true" @dragstart="hide(`card-${column}`)" :id="`card-${column}`"/>
        </div>
      </div>
    </div>
   </div>
</template>

<script setup>
import Button from '../components/shared/Button.vue'
import Fab from '../components/shared/Fab.vue'
import Tag from '../components/shared/Tag.vue'
import Card from '../components/shared/Card.vue'

const hide = (id) => {
  document.getElementById(id).style.visibility = 'hidden';
}
</script>

<style>

</style>